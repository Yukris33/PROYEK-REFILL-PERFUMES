@extends('admin.layouts.app')

@section('title', 'Rating & Ulasan - SCENTCYCLE')
@section('page_title', 'Rating & Ulasan')

@section('content')

    {{-- =========================
        KPI REVIEW
    ========================== --}}
    <section class="admin-review-kpi-grid">

        <article class="admin-review-kpi-card">
            <span>Total Ulasan</span>
            <strong>{{ number_format($totalReviews, 0, ',', '.') }}</strong>
            <small>Seluruh rating yang masuk</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--rating">
            <span>Rata-rata Rating</span>
            <strong>
                {{ $averageRating ? number_format($averageRating, 1, ',', '.') : '0,0' }}
                <small>/ 5</small>
            </strong>
            <small>Akumulasi seluruh penilaian</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--five-star">
            <span>Rating 5 Bintang</span>
            <strong>{{ number_format($fiveStarReviews, 0, ',', '.') }}</strong>
            <small>Review dengan kepuasan tertinggi</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--comment">
            <span>Ulasan dengan Komentar</span>
            <strong>{{ number_format($reviewsWithComment, 0, ',', '.') }}</strong>
            <small>Feedback tertulis dari customer</small>
        </article>

    </section>


    {{-- =========================
        FILTER REVIEW
    ========================== --}}
    <section class="admin-review-filter-card">
        <div class="admin-review-filter-head">
            <div>
                <span>Filter Ulasan</span>
                <h2>Pantau rating dan komentar customer</h2>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.reviews.index') }}" class="admin-review-filter-form">

            <div class="admin-review-filter-field admin-review-filter-field--search">
                <label for="search">Cari Ulasan</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ $search }}"
                    placeholder="Nama customer, email, produk, atau isi komentar..."
                >
            </div>

            <div class="admin-review-filter-field">
                <label for="rating">Filter Rating</label>
                <select name="rating" id="rating">
                    <option value="">Semua Rating</option>
                    <option value="5" {{ (string) $rating === '5' ? 'selected' : '' }}>5 Bintang</option>
                    <option value="4" {{ (string) $rating === '4' ? 'selected' : '' }}>4 Bintang</option>
                    <option value="3" {{ (string) $rating === '3' ? 'selected' : '' }}>3 Bintang</option>
                    <option value="2" {{ (string) $rating === '2' ? 'selected' : '' }}>2 Bintang</option>
                    <option value="1" {{ (string) $rating === '1' ? 'selected' : '' }}>1 Bintang</option>
                </select>
            </div>

            <div class="admin-review-filter-actions">
                <button type="submit" class="admin-review-btn admin-review-btn--primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <a href="{{ route('admin.reviews.index') }}" class="admin-review-btn admin-review-btn--ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>
    </section>


    {{-- =========================
        TABLE REVIEW
    ========================== --}}
    <section class="admin-review-table-card">
        <div class="admin-review-table-head">
            <div>
                <span>Daftar Ulasan</span>
                <h2>Rating & Komentar Customer</h2>
            </div>

            <div class="admin-review-result-pill">
                {{ number_format($reviews->total(), 0, ',', '.') }} data ditemukan
            </div>
        </div>

        <div class="admin-review-table-wrap">
            <table class="admin-review-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Produk</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <div class="admin-review-customer">
                                    <strong>{{ $review->user->name ?? 'User Tidak Ditemukan' }}</strong>
                                    <span>{{ $review->user->email ?? '-' }}</span>
                                </div>
                            </td>

                            <td>
                                <div class="admin-review-product">
                                    <strong>{{ $review->product->name ?? $review->orderItem->product_name_snapshot ?? '-' }}</strong>
                                    <span>
                                        {{ $review->orderItem->size_snapshot ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="admin-review-rating">
                                    <div class="admin-review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                    <strong>{{ $review->rating }}/5</strong>
                                </div>
                            </td>

                            <td>
                                @if($review->comment)
                                    <div class="admin-review-comment">
                                        {{ $review->comment }}
                                    </div>
                                @else
                                    <span class="admin-review-no-comment">Tanpa komentar</span>
                                @endif
                            </td>

                            <td>
                                {{ $review->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="admin-review-empty">
                                    <i class="bi bi-chat-square-heart"></i>
                                    <strong>Belum ada ulasan yang sesuai.</strong>
                                    <span>Coba ubah filter atau tunggu customer memberi rating.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
            <div class="admin-review-pagination">
                {{ $reviews->links() }}
            </div>
        @endif
    </section>

@endsection