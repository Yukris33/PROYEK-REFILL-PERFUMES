<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
{
    /*
    |--------------------------------------------------------------------------
    | KPI UTAMA - TETAP KESELURUHAN
    |--------------------------------------------------------------------------
    */
    $totalRevenue = Payment::where('status', 'paid')->sum('amount');

    $totalOrders = Order::count();

    $paidOrders = Order::where('payment_status', 'paid')->count();

    $totalUsers = User::where('role', 'user')->count();

    $usedVouchers = UserVoucher::where('status', 'used')->count();

    $totalUserPoints = User::where('role', 'user')->sum('points_balance');

    $averageRating = ProductReview::avg('rating');


    /*
    |--------------------------------------------------------------------------
    | FILTER PERIODE CHART
    |--------------------------------------------------------------------------
    */
    $period = request('period', 'all');

   $allowedPeriods = collect(['all'])
    ->merge(
        collect(range(1, 12))->map(fn ($month) => (string) $month)
    );

    if (!$allowedPeriods->contains($period)) {
        $period = 'all';
    }

    $startDate = null;

    if ($period !== 'all') {
        $startDate = Carbon::today()->subMonths((int) $period)->startOfDay();
    }

    $periodLabel = $period === 'all'
        ? 'Keseluruhan'
        : $period . ' Bulan Terakhir';


    /*
    |--------------------------------------------------------------------------
    | RENTANG LABEL TREN PENDAPATAN & USER BARU
    | Jika keseluruhan / lebih dari 3 bulan → tampil per bulan
    | Jika 1-3 bulan → tampil per hari
    |--------------------------------------------------------------------------
    */
    $useMonthlyGrouping = $period === 'all' || (int) $period > 3;

    $trendLabels = collect();
    $trendKeys = collect();

    if ($useMonthlyGrouping) {
        $trendStart = $startDate
            ? $startDate->copy()->startOfMonth()
            : Payment::min('created_at');

        $trendStart = $trendStart
            ? Carbon::parse($trendStart)->startOfMonth()
            : Carbon::today()->startOfMonth();

        $trendEnd = Carbon::today()->startOfMonth();

        $cursor = $trendStart->copy();

        while ($cursor <= $trendEnd) {
            $trendKeys->push($cursor->format('Y-m'));
            $trendLabels->push($cursor->format('M Y'));
            $cursor->addMonth();
        }
    } else {
        $trendStart = $startDate
            ? $startDate->copy()->startOfDay()
            : Carbon::today()->subMonth()->startOfDay();

        $trendEnd = Carbon::today()->startOfDay();

        $cursor = $trendStart->copy();

        while ($cursor <= $trendEnd) {
            $trendKeys->push($cursor->format('Y-m-d'));
            $trendLabels->push($cursor->format('d M'));
            $cursor->addDay();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 1. TREN PENDAPATAN
    |--------------------------------------------------------------------------
    */
    $revenueQuery = Payment::query()
        ->where('status', 'paid');

    if ($startDate) {
        $revenueQuery->where('created_at', '>=', $startDate);
    }

    if ($useMonthlyGrouping) {
        $revenueRaw = $revenueQuery
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as period_key"),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('period_key')
            ->pluck('total', 'period_key');
    } else {
        $revenueRaw = $revenueQuery
            ->select(
                DB::raw('DATE(created_at) as period_key'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('period_key')
            ->pluck('total', 'period_key');
    }

    $revenueChartLabels = $trendLabels->values();

    $revenueChartData = $trendKeys
        ->map(fn ($key) => (float) ($revenueRaw[$key] ?? 0))
        ->values();


    /*
    |--------------------------------------------------------------------------
    | 2. PRODUK TERLARIS SESUAI PERIODE
    |--------------------------------------------------------------------------
    */
    $topProductsQuery = DB::table('order_items')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.payment_status', 'paid');

    if ($startDate) {
        $topProductsQuery->where('orders.created_at', '>=', $startDate);
    }

    $topProducts = $topProductsQuery
        ->select(
            'order_items.product_name_snapshot as product_name',
            DB::raw('SUM(order_items.qty) as total_sold')
        )
        ->groupBy('order_items.product_name_snapshot')
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    $topProductLabels = $topProducts->pluck('product_name')->values();

    $topProductData = $topProducts
        ->pluck('total_sold')
        ->map(fn ($qty) => (int) $qty)
        ->values();


    /*
    |--------------------------------------------------------------------------
    | 3. METODE PEMBAYARAN SESUAI PERIODE
    |--------------------------------------------------------------------------
    */
    $paymentMethodsQuery = Payment::query()
        ->where('status', 'paid');

    if ($startDate) {
        $paymentMethodsQuery->where('created_at', '>=', $startDate);
    }

    $paymentMethods = $paymentMethodsQuery
        ->select(
            'method',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('method')
        ->orderByDesc('total')
        ->get();

    $paymentMethodLabels = $paymentMethods->pluck('method')->values();

    $paymentMethodData = $paymentMethods
        ->pluck('total')
        ->map(fn ($total) => (int) $total)
        ->values();


    /*
    |--------------------------------------------------------------------------
    | 4. DISTRIBUSI RATING SESUAI PERIODE
    |--------------------------------------------------------------------------
    */
    $ratingQuery = ProductReview::query();

    if ($startDate) {
        $ratingQuery->where('created_at', '>=', $startDate);
    }

    $ratingRaw = $ratingQuery
        ->select(
            'rating',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('rating')
        ->pluck('total', 'rating');

    $ratingLabels = collect([
        '1 Bintang',
        '2 Bintang',
        '3 Bintang',
        '4 Bintang',
        '5 Bintang'
    ]);

    $ratingData = collect([1, 2, 3, 4, 5])
        ->map(fn ($rating) => (int) ($ratingRaw[$rating] ?? 0))
        ->values();


    /*
    |--------------------------------------------------------------------------
    | 5. TREN USER BARU SESUAI PERIODE
    |--------------------------------------------------------------------------
    */
    $newUsersQuery = User::query()
        ->where('role', 'user');

    if ($startDate) {
        $newUsersQuery->where('created_at', '>=', $startDate);
    }

    if ($useMonthlyGrouping) {
        $newUsersRaw = $newUsersQuery
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as period_key"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('period_key')
            ->pluck('total', 'period_key');
    } else {
        $newUsersRaw = $newUsersQuery
            ->select(
                DB::raw('DATE(created_at) as period_key'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('period_key')
            ->pluck('total', 'period_key');
    }

    $newUserChartLabels = $trendLabels->values();

    $newUserChartData = $trendKeys
        ->map(fn ($key) => (int) ($newUsersRaw[$key] ?? 0))
        ->values();

         /*
        |--------------------------------------------------------------------------
        | 5. DISTRIBUSI STATUS PESANAN SESUAI PERIODE
        |--------------------------------------------------------------------------
        */
        $orderStatusQuery = Order::query();

        if ($startDate) {
            $orderStatusQuery->where('created_at', '>=', $startDate);
        }

        $orderStatusRaw = $orderStatusQuery
            ->select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();

        $orderStatusLabels = $orderStatusRaw
            ->pluck('status')
            ->map(fn ($status) => ucfirst($status))
            ->values();

        $orderStatusData = $orderStatusRaw
            ->pluck('total')
            ->map(fn ($total) => (int) $total)
            ->values();


    return view('admin.dashboard', compact(
        'totalRevenue',
        'totalOrders',
        'paidOrders',
        'totalUsers',
        'usedVouchers',
        'totalUserPoints',
        'averageRating',

        'period',
        'periodLabel',

        'revenueChartLabels',
        'revenueChartData',

        'topProductLabels',
        'topProductData',

        'paymentMethodLabels',
        'paymentMethodData',

        'ratingLabels',
        'ratingData',
        'orderStatusLabels',
        'orderStatusData',

        'newUserChartLabels',
        'newUserChartData'
    ));
}
    }
