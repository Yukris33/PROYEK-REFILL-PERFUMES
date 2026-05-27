@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - SCENTCYCLE')
@section('page_title', 'Dashboard Admin')

@section('content')

    {{-- =========================
        KPI UTAMA
    ========================== --}}
    <section class="admin-kpi-grid">

        <article class="admin-kpi-card admin-kpi-card--revenue">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Total Pendapatan</span>
                <strong>Rp{{ number_format($totalRevenue, 0, ',', '.') }}</strong>
                <small>Dari pembayaran berstatus paid</small>
            </div>
        </article>

        <article class="admin-kpi-card">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-bag"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Total Pesanan</span>
                <strong>{{ number_format($totalOrders, 0, ',', '.') }}</strong>
                <small>Semua order yang tercatat</small>
            </div>
        </article>

        <article class="admin-kpi-card admin-kpi-card--success">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Pesanan Paid</span>
                <strong>{{ number_format($paidOrders, 0, ',', '.') }}</strong>
                <small>Order dengan pembayaran berhasil</small>
            </div>
        </article>

        <article class="admin-kpi-card">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-people"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Total User</span>
                <strong>{{ number_format($totalUsers, 0, ',', '.') }}</strong>
                <small>Akun customer terdaftar</small>
            </div>
        </article>

        <article class="admin-kpi-card admin-kpi-card--voucher">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-ticket-perforated"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Voucher Terpakai</span>
                <strong>{{ number_format($usedVouchers, 0, ',', '.') }}</strong>
                <small>Voucher dengan status used</small>
            </div>
        </article>

        <article class="admin-kpi-card admin-kpi-card--points">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-coin"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Total Poin User</span>
                <strong>{{ number_format($totalUserPoints, 0, ',', '.') }}</strong>
                <small>Poin aktif yang tersimpan</small>
            </div>
        </article>

        <article class="admin-kpi-card admin-kpi-card--rating">
            <div class="admin-kpi-card__icon">
                <i class="bi bi-star-fill"></i>
            </div>

            <div class="admin-kpi-card__content">
                <span>Rata-rata Rating</span>
                <strong>
                    {{ $averageRating ? number_format($averageRating, 1, ',', '.') : '0,0' }}
                    <small class="admin-rating-max">/ 5</small>
                </strong>
                <small>Dari seluruh ulasan produk</small>
            </div>
        </article>

    </section>


    {{-- =========================
        FILTER PERIODE GRAFIK
    ========================== --}}
    <section class="admin-period-filter">
        <div>
            <span class="admin-period-filter__eyebrow">Filter Analitik</span>
            <h2>Periode Grafik: {{ $periodLabel }}</h2>
        </div>

        <form method="GET" action="{{ route('admin.dashboard') }}" class="admin-period-form">
            <label for="period">Tampilkan data</label>

            <select name="period" id="period" onchange="this.form.submit()">
                <option value="all" {{ $period === 'all' ? 'selected' : '' }}>
                    Keseluruhan
                </option>

                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ (string) $period === (string) $i ? 'selected' : '' }}>
                        {{ $i }} Bulan Terakhir
                    </option>
                @endfor
            </select>
        </form>
    </section>


    {{-- =========================
        NOTE OVERVIEW
    ========================== --}}
    <section class="admin-dashboard-note">
        <div class="admin-dashboard-note__icon">
            <i class="bi bi-bar-chart-line"></i>
        </div>

        <div>
            <h2>Overview bisnis sudah aktif</h2>
            <p>
                KPI utama sudah mengambil data langsung dari database.
                Grafik di bawah menampilkan performa penjualan, produk terlaris,
                metode pembayaran, rating pelanggan, status pesanan, dan pertumbuhan akun
                berdasarkan periode analitik yang dipilih.
            </p>
        </div>
    </section>


    {{-- =========================
        CHART DASHBOARD
    ========================== --}}
    <section class="admin-chart-grid">

        {{-- 1. Revenue --}}
        <article class="admin-chart-card admin-chart-card--wide">
            <div class="admin-chart-card__head">
                <div>
                    <span>Revenue Analytics</span>
                    <h2>Tren Pendapatan — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap">
                <canvas id="revenueChart"></canvas>
            </div>
        </article>

        {{-- 2. Top Produk --}}
        <article class="admin-chart-card">
            <div class="admin-chart-card__head">
                <div>
                    <span>Sales Performance</span>
                    <h2>Top 5 Produk Terlaris — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap">
                <canvas id="topProductsChart"></canvas>
            </div>
        </article>

        {{-- 3. Metode Pembayaran --}}
        <article class="admin-chart-card">
            <div class="admin-chart-card__head">
                <div>
                    <span>Payment Insight</span>
                    <h2>Metode Pembayaran Paid — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap admin-chart-wrap--doughnut">
                <canvas id="paymentMethodChart"></canvas>
            </div>
        </article>

        {{-- 4. Distribusi Rating --}}
        <article class="admin-chart-card">
            <div class="admin-chart-card__head">
                <div>
                    <span>Customer Feedback</span>
                    <h2>Distribusi Rating Produk — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap">
                <canvas id="ratingChart"></canvas>
            </div>
        </article>

        {{-- 5. Status Pesanan --}}
        <article class="admin-chart-card">
            <div class="admin-chart-card__head">
                <div>
                    <span>Order Monitoring</span>
                    <h2>Status Pesanan — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap admin-chart-wrap--doughnut">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </article>

        {{-- 6. User Baru --}}
        <article class="admin-chart-card admin-chart-card--wide">
            <div class="admin-chart-card__head">
                <div>
                    <span>User Growth</span>
                    <h2>Akun Baru — {{ $periodLabel }}</h2>
                </div>
            </div>

            <div class="admin-chart-wrap">
                <canvas id="newUsersChart"></canvas>
            </div>
        </article>

    </section>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    Chart.register(ChartDataLabels);

    const revenueLabels = @json($revenueChartLabels);
    const revenueData = @json($revenueChartData);

    const topProductLabels = @json($topProductLabels);
    const topProductData = @json($topProductData);

    const paymentMethodLabels = @json($paymentMethodLabels);
    const paymentMethodData = @json($paymentMethodData);

    const ratingLabels = @json($ratingLabels);
    const ratingData = @json($ratingData);

    const orderStatusLabels = @json($orderStatusLabels);
    const orderStatusData = @json($orderStatusData);

    const newUserLabels = @json($newUserChartLabels);
    const newUserData = @json($newUserChartData);

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    font: {
                        size: 12,
                        weight: '600'
                    }
                }
            },
            datalabels: {
                color: '#111',
                anchor: 'end',
                align: 'top',
                offset: 4,
                font: {
                    size: 11,
                    weight: '700'
                },
                formatter: function(value) {
                    return value > 0
                        ? new Intl.NumberFormat('id-ID').format(value)
                        : '';
                }
            }
        }
    };

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Pendapatan',
                data: revenueData,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                ...commonOptions.plugins,
                datalabels: {
                    ...commonOptions.plugins.datalabels,
                    formatter: function(value) {
                        return value > 0
                            ? 'Rp' + new Intl.NumberFormat('id-ID').format(value)
                            : '';
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: topProductLabels,
            datasets: [{
                label: 'Qty Terjual',
                data: topProductData
            }]
        },
        options: {
            ...commonOptions,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('paymentMethodChart'), {
        type: 'doughnut',
        data: {
            labels: paymentMethodLabels,
            datasets: [{
                label: 'Total Pembayaran',
                data: paymentMethodData
            }]
        },
        options: {
            ...commonOptions,
            cutout: '62%',
            plugins: {
                ...commonOptions.plugins,
                datalabels: {
                    color: '#111',
                    font: {
                        size: 12,
                        weight: '800'
                    },
                    formatter: function(value) {
                        return value > 0
                            ? new Intl.NumberFormat('id-ID').format(value)
                            : '';
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('ratingChart'), {
        type: 'bar',
        data: {
            labels: ratingLabels,
            datasets: [{
                label: 'Jumlah Ulasan',
                data: ratingData
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut',
        data: {
            labels: orderStatusLabels,
            datasets: [{
                label: 'Jumlah Pesanan',
                data: orderStatusData
            }]
        },
        options: {
            ...commonOptions,
            cutout: '62%',
            plugins: {
                ...commonOptions.plugins,
                datalabels: {
                    color: '#111',
                    font: {
                        size: 12,
                        weight: '800'
                    },
                    formatter: function(value) {
                        return value > 0
                            ? new Intl.NumberFormat('id-ID').format(value)
                            : '';
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('newUsersChart'), {
        type: 'line',
        data: {
            labels: newUserLabels,
            datasets: [{
                label: 'User Baru',
                data: newUserData,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endpush