<?php

namespace App\Http\Controllers;

use App\Models\PartnershipRequest;
use App\Models\SupportTicket;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Models\VoucherStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoucherBantuanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $vouchers = Voucher::with('stocks')
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', now()->toDateString());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now()->toDateString());
            })
            ->orderBy('points_cost')
            ->get();

        $claimedVouchers = collect();
        $claimedVoucherIds = [];
        $latestVoucher = null;
        $supportTickets = collect();

        if ($user) {
            $claimedVouchers = UserVoucher::with('voucher')
                ->where('user_id', $user->id)
                ->latest()
                ->get();

            $claimedVoucherIds = $claimedVouchers
                ->where('status', 'claimed')
                ->pluck('voucher_id')
                ->toArray();

            $latestVoucher = $claimedVouchers->first();

            $supportTickets = SupportTicket::where('user_id', $user->id)
                ->latest()
                ->limit(5)
                ->get();
        }

        return view('voucher-bantuan', compact(
            'vouchers',
            'claimedVouchers',
            'claimedVoucherIds',
            'latestVoucher',
            'supportTickets'
        ));
    }

    public function checkVoucherStock(Request $request, Voucher $voucher)
    {
        if (!Auth::check()) {
            return response()->json([
                'ok' => false,
                'message' => 'Login dulu untuk cek dan klaim voucher.',
            ], 401);
        }

        $validated = $request->validate([
            'machine_location' => ['required', 'in:UMN,SMS,AEON BSD'],
            'voucher_stock_id' => ['required', 'integer', 'exists:voucher_stocks,id'],
        ]);

        $stock = VoucherStock::where('id', $validated['voucher_stock_id'])
            ->where('voucher_id', $voucher->id)
            ->where('machine_location', $validated['machine_location'])
            ->where('is_active', true)
            ->first();

        if (!$stock) {
            return response()->json([
                'ok' => false,
                'message' => 'Stok voucher tidak tersedia di lokasi ini.',
            ], 422);
        }

        $availableStock = max(0, $stock->stock_qty - $stock->reserved_qty);

        if ($availableStock <= 0) {
            return response()->json([
                'ok' => false,
                'message' => 'Stok habis di lokasi ini. Silakan pilih lokasi atau varian lain.',
            ], 422);
        }

        if (Auth::user()->points_balance < $voucher->points_cost) {
            return response()->json([
                'ok' => false,
                'message' => 'Poin kamu belum cukup untuk klaim voucher ini.',
            ], 422);
        }

        return response()->json([
            'ok' => true,
            'message' => 'Stok tersedia. Kamu bisa lanjut menukar poin.',
            'stock' => $availableStock,
            'variant_name' => $stock->variant_name,
            'points_cost' => $voucher->points_cost,
        ]);
    }

    public function claimVoucher(Request $request, Voucher $voucher)
{
    if (!Auth::check()) {
        return redirect()
            ->route('login')
            ->with('error', 'Login dulu untuk klaim voucher.');
    }

    $user = Auth::user();
    $isMachineReward = $voucher->reward_type === 'free_refill';

    if (!$voucher->isAvailable()) {
        return back()->with('error', 'Voucher belum aktif atau sudah berakhir.');
    }

    if ($isMachineReward) {
        $validated = $request->validate([
            'machine_location' => ['required', 'in:UMN,SMS,AEON BSD'],
            'voucher_stock_id' => ['required', 'integer', 'exists:voucher_stocks,id'],
            'confirm_redeem' => ['required', 'accepted'],
        ]);

        $claimCount = UserVoucher::where('user_id', $user->id)
            ->where('voucher_id', $voucher->id)
            ->count();

        if ($claimCount >= $voucher->max_claim_per_user) {
    return back()->with('error', 'Batas maksimal klaim voucher ini sudah tercapai.');
}

        return DB::transaction(function () use ($user, $voucher, $validated) {
            $stock = VoucherStock::where('id', $validated['voucher_stock_id'])
                ->where('voucher_id', $voucher->id)
                ->where('machine_location', $validated['machine_location'])
                ->where('is_active', true)
                ->lockForUpdate()
                ->first();

            if (!$stock) {
                return back()->with('error', 'Stok voucher tidak tersedia di lokasi ini.');
            }

            $availableStock = max(0, $stock->stock_qty - $stock->reserved_qty);

            if ($availableStock <= 0) {
                return back()->with('error', 'Stok habis. Silakan pilih lokasi atau varian lain.');
            }

            $lockedUser = \App\Models\User::where('id', $user->id)
    ->lockForUpdate()
    ->firstOrFail();

if ($lockedUser->points_balance < $voucher->points_cost) {
    return back()->with('error', 'Poin kamu belum cukup untuk klaim voucher ini.');
}

if ($voucher->points_cost > 0) {
    $lockedUser->decrement('points_balance', $voucher->points_cost);

    DB::table('point_transactions')->insert([
        'user_id' => $lockedUser->id,
        'order_id' => null,
        'type' => 'redeem',
        'points' => -abs($voucher->points_cost),
        'description' => 'Redeem voucher QR vending: ' . $voucher->name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

            $stock->increment('reserved_qty');

            $userVoucher = UserVoucher::create([
                'user_id' => $lockedUser->id,
                'voucher_id' => $voucher->id,
                'voucher_stock_id' => $stock->id,
                'machine_location' => $stock->machine_location,
                'variant_name' => $stock->variant_name,
                'code' => $this->generateVoucherCode(),
                'usage_channel' => 'machine_qr',
                'status' => 'claimed',
                'claimed_at' => now(),
            ]);

            return redirect()
                ->route('nav.voucher-bantuan')
                ->with('success', 'Free Testing Spray berhasil diklaim. QR voucher dibuat: ' . $userVoucher->code);
        });
    }

    $validated = $request->validate([
        'confirm_redeem' => ['required', 'accepted'],
    ]);

    return DB::transaction(function () use ($user, $voucher) {
        $lockedUser = \App\Models\User::where('id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($lockedUser->points_balance < $voucher->points_cost) {
            return back()->with('error', 'Poin kamu belum cukup untuk klaim voucher ini.');
        }

        if ($voucher->points_cost > 0) {
            $lockedUser->decrement('points_balance', $voucher->points_cost);

            DB::table('point_transactions')->insert([
                'user_id' => $lockedUser->id,
                'order_id' => null,
                'type' => 'redeem',
                'points' => -abs($voucher->points_cost),
                'description' => 'Redeem voucher checkout: ' . $voucher->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $userVoucher = UserVoucher::create([
            'user_id' => $lockedUser->id,
            'voucher_id' => $voucher->id,
            'code' => $this->generateVoucherCode(),
            'usage_channel' => 'checkout',
            'status' => 'claimed',
            'claimed_at' => now(),
        ]);

        return redirect()
            ->route('nav.voucher-bantuan')
            ->with('success', 'Voucher berhasil diklaim. Voucher akan bisa digunakan nanti di halaman scent/refill: ' . $userVoucher->code);
    });
}

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'in:mesin,transaksi,voucher,lainnya'],
            'subject' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return redirect()
            ->route('nav.voucher-bantuan')
            ->with('success', 'Laporan berhasil dikirim. Tim kami akan mengecek kendala kamu.');
    }

    public function storePartnership(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'phone' => ['nullable', 'string', 'max:30'],
            'business_name' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        PartnershipRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'business_name' => $validated['business_name'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()
            ->route('nav.voucher-bantuan')
            ->with('success', 'Request kerja sama berhasil dikirim. Tim kami akan menghubungi kamu.');
    }

    private function generateVoucherCode()
    {
        do {
            $code = 'VCR-SCENT-' . strtoupper(Str::random(6));
        } while (UserVoucher::where('code', $code)->exists());

        return $code;
    }
}