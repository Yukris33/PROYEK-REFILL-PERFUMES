<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ], [
            'rating.required' => 'Pilih rating bintang terlebih dahulu.',
            'rating.integer' => 'Rating tidak valid.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.max' => 'Komentar maksimal 500 karakter.',
        ]);

        $order = $orderItem->order;

        /*
        |--------------------------------------------------------------------------
        | VALIDASI KEAMANAN REVIEW
        |--------------------------------------------------------------------------
        | 1. Order item harus punya order
        | 2. Order harus milik user yang sedang login
        | 3. Pembayaran order harus sudah berhasil
        */
        if (!$order || $order->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak memiliki akses untuk memberi rating pada pesanan ini.');
        }

        if ($order->payment_status !== 'paid') {
            return back()->with('error', 'Rating hanya bisa diberikan setelah pembayaran berhasil.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEGAH RATING GANDA
        |--------------------------------------------------------------------------
        | Satu item pesanan hanya boleh punya satu review.
        */
        $alreadyReviewed = ProductReview::where('order_item_id', $orderItem->id)->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Produk ini sudah pernah kamu beri rating.');
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN REVIEW
        |--------------------------------------------------------------------------
        */
        ProductReview::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'order_item_id' => $orderItem->id,
            'product_id' => $orderItem->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Rating dan komentar berhasil dikirim.');
    }
}