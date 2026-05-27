<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\BottleReturn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $orders = Order::with([
        'items.product',
        'items.review'
    ])
    ->where('user_id', $userId)
    ->latest()
    ->get();

        $pointTransactions = DB::table('point_transactions')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $bottleReturns = BottleReturn::with('items')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('history.index', compact(
            'orders',
            'pointTransactions',
            'bottleReturns'
        ));
    }
}