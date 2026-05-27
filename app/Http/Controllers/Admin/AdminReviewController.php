<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $rating = $request->query('rating');

        $reviews = ProductReview::with([
                'user',
                'product',
                'orderItem',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('comment', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('product', function ($productQuery) use ($search) {
                            $productQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($rating, function ($query) use ($rating) {
                $query->where('rating', $rating);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalReviews = ProductReview::count();

        $averageRating = ProductReview::avg('rating');

        $fiveStarReviews = ProductReview::where('rating', 5)->count();

        $reviewsWithComment = ProductReview::whereNotNull('comment')
            ->where('comment', '!=', '')
            ->count();

        return view('admin.reviews.index', compact(
            'reviews',
            'totalReviews',
            'averageRating',
            'fiveStarReviews',
            'reviewsWithComment',
            'search',
            'rating'
        ));
    }
}