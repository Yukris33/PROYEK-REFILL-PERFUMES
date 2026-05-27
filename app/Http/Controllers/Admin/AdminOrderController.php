<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $orderStatus = $request->query('order_status');
        $paymentStatus = $request->query('payment_status');
        $paymentMethod = $request->query('payment_method');

        $orders = Order::with(['user', 'payment'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('order_code', 'like', '%' . $search . '%')
                        ->orWhere('customer_name', 'like', '%' . $search . '%')
                        ->orWhere('customer_email', 'like', '%' . $search . '%');
                });
            })
            ->when($orderStatus, function ($query) use ($orderStatus) {
                $query->where('status', $orderStatus);
            })
            ->when($paymentStatus, function ($query) use ($paymentStatus) {
                $query->where('payment_status', $paymentStatus);
            })
            ->when($paymentMethod, function ($query) use ($paymentMethod) {
                $query->whereHas('payment', function ($paymentQuery) use ($paymentMethod) {
                    $paymentQuery->where('method', $paymentMethod);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalOrders = Order::count();

        $paidOrders = Order::where('payment_status', 'paid')->count();

        $unpaidOrders = Order::where('payment_status', 'unpaid')->count();

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');

        $paymentMethods = Payment::select('method')
            ->distinct()
            ->orderBy('method')
            ->pluck('method');

        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'paidOrders',
            'unpaidOrders',
            'totalRevenue',
            'paymentMethods',
            'search',
            'orderStatus',
            'paymentStatus',
            'paymentMethod'
        ));
    }

    public function show(Order $order)
{
    $order->load([
        'user',
        'payment',
        'items',
    ]);

    return view('admin.orders.show', compact('order'));
}

public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'status' => ['required', 'in:pending,processing,completed,cancelled'],
        'payment_status' => ['required', 'in:unpaid,paid,failed,refunded'],
    ], [
        'status.required' => 'Status pesanan wajib dipilih.',
        'status.in' => 'Status pesanan tidak valid.',
        'payment_status.required' => 'Status pembayaran wajib dipilih.',
        'payment_status.in' => 'Status pembayaran tidak valid.',
    ]);

    $order->update([
        'status' => $validated['status'],
        'payment_status' => $validated['payment_status'],
    ]);

    if ($order->payment) {
        $order->payment->update([
            'status' => $validated['payment_status'],
        ]);
    }

    return redirect()
        ->route('admin.orders.show', $order)
        ->with('success', 'Status pesanan dan pembayaran berhasil diperbarui.');
}


}