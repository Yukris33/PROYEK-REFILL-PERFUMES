<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Models\VoucherStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminVoucherPointController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $voucherStatus = $request->query('voucher_status');
        $rewardType = $request->query('reward_type');
        $pointType = $request->query('point_type');

        /*
        |--------------------------------------------------------------------------
        | KPI UTAMA
        |--------------------------------------------------------------------------
        */

        $totalCustomerPoints = User::where('role', 'user')
            ->sum('points_balance');

        $totalClaimedVouchers = UserVoucher::count();

        $totalUsedVouchers = UserVoucher::where('status', 'used')
            ->count();

        $activeVouchers = Voucher::where('is_active', true)
            ->count();

        $totalPointsEarned = PointTransaction::where('points', '>', 0)
            ->sum('points');

        $totalPointsRedeemed = abs(
            PointTransaction::where('points', '<', 0)
                ->sum('points')
        );


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT VOUCHER CUSTOMER
        |--------------------------------------------------------------------------
        */

        $userVouchers = UserVoucher::with([
                'user',
                'voucher',
                'voucherStock',
            ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('code', 'like', '%' . $search . '%')
                        ->orWhere('machine_location', 'like', '%' . $search . '%')
                        ->orWhere('variant_name', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('voucher', function ($voucherQuery) use ($search) {
                            $voucherQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($voucherStatus, function ($query) use ($voucherStatus) {
                $query->where('status', $voucherStatus);
            })
            ->latest('claimed_at')
            ->paginate(8, ['*'], 'voucher_page')
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT TRANSAKSI POIN CUSTOMER
        |--------------------------------------------------------------------------
        */

        $pointTransactions = PointTransaction::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('description', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($pointType, function ($query) use ($pointType) {
                $query->where('type', $pointType);
            })
            ->latest()
            ->paginate(8, ['*'], 'point_page')
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | DAFTAR MASTER VOUCHER
        |--------------------------------------------------------------------------
        */

        $vouchers = Voucher::withCount('userVouchers')
            ->when($rewardType, function ($query) use ($rewardType) {
                $query->where('reward_type', $rewardType);
            })
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOK VOUCHER PER LOKASI
        |--------------------------------------------------------------------------
        */

        $voucherStocks = VoucherStock::with('voucher')
            ->orderBy('machine_location')
            ->orderBy('variant_name')
            ->get();


        return view('admin.vouchers.index', compact(
            'search',
            'voucherStatus',
            'rewardType',
            'pointType',
            'totalCustomerPoints',
            'totalClaimedVouchers',
            'totalUsedVouchers',
            'activeVouchers',
            'totalPointsEarned',
            'totalPointsRedeemed',
            'userVouchers',
            'pointTransactions',
            'vouchers',
            'voucherStocks'
        ));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],

            'points_cost' => ['required', 'integer', 'min:0'],
            'reward_type' => ['required', 'in:discount_percent,discount_amount,free_refill'],
            'reward_value' => ['required', 'numeric', 'min:0'],

            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],

            'max_claim_per_user' => ['required', 'integer', 'min:1', 'max:100'],
            'is_active' => ['nullable', 'boolean'],

            // Khusus QR Vending / Free Refill
            'variant_name' => ['nullable', 'required_if:reward_type,free_refill', 'string', 'max:150'],
            'stock_umn' => ['nullable', 'required_if:reward_type,free_refill', 'integer', 'min:0'],
            'stock_sms' => ['nullable', 'required_if:reward_type,free_refill', 'integer', 'min:0'],
            'stock_aeon' => ['nullable', 'required_if:reward_type,free_refill', 'integer', 'min:0'],
        ], [
            'name.required' => 'Nama voucher wajib diisi.',
            'points_cost.required' => 'Biaya poin wajib diisi.',
            'reward_type.required' => 'Jenis voucher wajib dipilih.',
            'reward_value.required' => 'Nilai reward wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.',
            'variant_name.required_if' => 'Nama varian mesin wajib diisi untuk voucher QR vending.',
            'stock_umn.required_if' => 'Stok UMN wajib diisi untuk voucher QR vending.',
            'stock_sms.required_if' => 'Stok SMS wajib diisi untuk voucher QR vending.',
            'stock_aeon.required_if' => 'Stok AEON wajib diisi untuk voucher QR vending.',
        ]);

        DB::transaction(function () use ($validated) {
            $voucher = Voucher::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'points_cost' => $validated['points_cost'],
                'reward_type' => $validated['reward_type'],
                'reward_value' => $validated['reward_value'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'max_claim_per_user' => $validated['max_claim_per_user'],
                'requires_activity' => false,
                'is_active' => $validated['is_active'] ?? false,
            ]);

            /*
            |--------------------------------------------------------------------------
            | JIKA VOUCHER BERUPA QR VENDING / FREE REFILL
            | Otomatis bikin stok di 3 lokasi final:
            | UMN, SMS, AEON
            |--------------------------------------------------------------------------
            */
            if ($validated['reward_type'] === 'free_refill') {
                $stocks = [
                    [
                        'location' => 'UMN',
                        'qty' => $validated['stock_umn'],
                    ],
                    [
                        'location' => 'SMS',
                        'qty' => $validated['stock_sms'],
                    ],
                    [
                        'location' => 'AEON',
                        'qty' => $validated['stock_aeon'],
                    ],
                ];

                foreach ($stocks as $stock) {
                    VoucherStock::create([
                        'voucher_id' => $voucher->id,
                        'machine_location' => $stock['location'],
                        'variant_name' => $validated['variant_name'],
                        'stock_qty' => $stock['qty'],
                        'reserved_qty' => 0,
                        'is_active' => true,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.vouchers.index')
            ->with('success', 'Voucher baru berhasil ditambahkan dan akan tampil di halaman customer jika statusnya aktif.');
    }
}