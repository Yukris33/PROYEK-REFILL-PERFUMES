<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
  public function show(Request $request)
{
    $cart = $this->getActiveCart($request);

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
    }

    $firstItem = $cart->items->first();
    $totalItem = $cart->items->count();
    $grandTotal = $cart->items->sum('subtotal');

    $orderDate = now();

    $bonusPoints = auth()->check() ? floor($grandTotal / 10000) : null;

    // Kode unik dibuat saat halaman checkout dibuka
    // supaya bisa langsung ditampilkan ketika user pilih selain QRIS
    $checkoutUniqueCode = session('checkout_unique_code');

    if (!$checkoutUniqueCode) {
        $checkoutUniqueCode = rand(100, 999);
        session(['checkout_unique_code' => $checkoutUniqueCode]);
    }

    $checkoutVouchers = collect();

    if (Auth::check()) {
        $checkoutVouchers = UserVoucher::with('voucher')
            ->where('user_id', Auth::id())
            ->where('status', 'claimed')
            ->where('usage_channel', 'checkout')
            ->latest()
            ->get();
    }

    return view('checkout', compact(
        'cart',
        'firstItem',
        'totalItem',
        'grandTotal',
        'orderDate',
        'bonusPoints',
        'checkoutUniqueCode',
        'checkoutVouchers'
    ));
}

   public function store(Request $request)
{
    $request->validate([
        'payment_method' => 'required|string|max:50',
        'user_voucher_id' => 'nullable|integer|exists:user_vouchers,id',
    ]);

    $cart = $this->getActiveCart($request);

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
    }

    $subtotalBeforeDiscount = $cart->items->sum('subtotal');

    $discountAmount = 0;
    $userVoucher = null;

    DB::beginTransaction();

    try {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI & HITUNG VOUCHER
        |--------------------------------------------------------------------------
        | Voucher yang boleh dipakai di checkout hanya:
        | - milik user login
        | - status claimed
        | - usage_channel checkout
        */
        if ($request->filled('user_voucher_id')) {
            if (!auth()->check()) {
                DB::rollBack();
                return back()->with('error', 'Login dulu untuk memakai voucher.');
            }

            $userVoucher = UserVoucher::with('voucher')
                ->where('id', $request->user_voucher_id)
                ->where('user_id', auth()->id())
                ->where('status', 'claimed')
                ->where('usage_channel', 'checkout')
                ->lockForUpdate()
                ->first();

            if (!$userVoucher || !$userVoucher->voucher) {
                DB::rollBack();
                return back()->with('error', 'Voucher tidak valid atau sudah digunakan.');
            }

            $voucher = $userVoucher->voucher;

            if ($voucher->reward_type === 'discount_percent') {
                $discountAmount = round($subtotalBeforeDiscount * ((float) $voucher->reward_value / 100));
            } elseif ($voucher->reward_type === 'discount_amount') {
                $discountAmount = (int) $voucher->reward_value;
            } elseif ($voucher->reward_type === 'free_refill') {
                $rewardMl = (int) $voucher->reward_value;

                foreach ($cart->items as $item) {
                    $sizeMl = (int) ($item->variant->size_ml ?? 0);

                    if ($sizeMl > 0 && $rewardMl > 0) {
                        $coveredMl = min($rewardMl, $sizeMl);
                        $itemDiscount = ($coveredMl / $sizeMl) * $item->subtotal;
                        $discountAmount += round($itemDiscount);
                    }
                }
            }

            $discountAmount = min($discountAmount, $subtotalBeforeDiscount);
        }

        $grandTotal = max(0, $subtotalBeforeDiscount - $discountAmount);
        $pointsEarned = auth()->check() ? floor($grandTotal / 10000) : 0;

        $uniqueCode = 0;
        $paymentAmount = $grandTotal;

        // Selain QRIS pakai kode unik dari session checkout
        if ($request->payment_method !== 'QRIS') {
            $uniqueCode = session('checkout_unique_code', rand(100, 999));
            $paymentAmount = $grandTotal + $uniqueCode;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => auth()->check() ? auth()->user()->name : 'Guest',
            'customer_email' => auth()->check() ? auth()->user()->email : null,
            'customer_phone' => null,
            'shipping_address' => null,
            'order_code' => $this->generateOrderCode(),

            // subtotal tetap harga asli sebelum voucher
            'subtotal' => $subtotalBeforeDiscount,

            // diskon dari voucher
            'discount_amount' => $discountAmount,

            'points_used' => 0,
            'points_earned' => $pointsEarned,

            // grand_total sudah dipotong voucher
            'grand_total' => $grandTotal,

            'status' => 'pending',
            'payment_status' => 'unpaid',
            'notes' => $userVoucher
                ? 'Voucher digunakan: ' . $userVoucher->code . ' - ' . ($userVoucher->voucher->name ?? 'Voucher')
                : null,
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name_snapshot' => $item->product->name ?? 'Produk',
                'size_snapshot' => ($item->variant->size_ml ?? '-') . ' ml',
                'price' => $item->price_snapshot,
                'qty' => $item->qty,
                'subtotal' => $item->subtotal,
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'method' => $request->payment_method,
            'amount' => $paymentAmount,
            'status' => 'pending',
            'transaction_ref' => 'PAY-' . strtoupper(uniqid()),
            'proof_image' => null,
            'paid_at' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | TANDAI VOUCHER SUDAH DIPAKAI
        |--------------------------------------------------------------------------
        | Karena checkout sudah berhasil dibuat, voucher checkout berubah:
        | claimed -> used
        */
        if ($userVoucher) {
            $userVoucher->update([
                'status' => 'used',
                'used_at' => now(),
            ]);
        }

        // Setelah order dibuat, kode unik session dihapus
        // supaya transaksi berikutnya dapat kode unik baru
        session()->forget('checkout_unique_code');

        $cart->update([
            'status' => 'converted',
        ]);

        DB::commit();

        return redirect()->route('orders.status', $order->order_code);

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
    }
}

    public function refreshPaymentStatus($orderCode)
{
    $order = Order::with('payment')
        ->where('order_code', $orderCode)
        ->firstOrFail();

    if ($order->payment && $order->payment->status === 'paid') {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
    }

    return redirect()
        ->route('orders.status', $order->order_code)
        ->with('success', 'Status pembayaran berhasil diperbarui.');
}

    public function status($orderCode)
{
    $order = Order::with([
            'items.review',
            'payment'
        ])
        ->where('order_code', $orderCode)
        ->firstOrFail();

    return view('status-pesanan', compact('order'));
}

    private function getActiveCart(Request $request)
    {
        $cartQuery = Cart::with(['items.product', 'items.variant', 'user'])
            ->where('status', 'active');

        if (auth()->check()) {
            $cartQuery->where('user_id', auth()->id());
        } else {
            $cartQuery->where('session_id', $request->session()->getId());
        }

        return $cartQuery->latest()->first();
    }

    private function generateOrderCode()
    {
        return 'SCENT-' . now()->format('Ymd-His') . '-' . rand(100, 999);
    }
}