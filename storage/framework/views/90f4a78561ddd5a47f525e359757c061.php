

<?php $__env->startSection('title', 'Rating & Ulasan - SCENTCYCLE'); ?>
<?php $__env->startSection('page_title', 'Rating & Ulasan'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="admin-review-kpi-grid">

        <article class="admin-review-kpi-card">
            <span>Total Ulasan</span>
            <strong><?php echo e(number_format($totalReviews, 0, ',', '.')); ?></strong>
            <small>Seluruh rating yang masuk</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--rating">
            <span>Rata-rata Rating</span>
            <strong>
                <?php echo e($averageRating ? number_format($averageRating, 1, ',', '.') : '0,0'); ?>

                <small>/ 5</small>
            </strong>
            <small>Akumulasi seluruh penilaian</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--five-star">
            <span>Rating 5 Bintang</span>
            <strong><?php echo e(number_format($fiveStarReviews, 0, ',', '.')); ?></strong>
            <small>Review dengan kepuasan tertinggi</small>
        </article>

        <article class="admin-review-kpi-card admin-review-kpi-card--comment">
            <span>Ulasan dengan Komentar</span>
            <strong><?php echo e(number_format($reviewsWithComment, 0, ',', '.')); ?></strong>
            <small>Feedback tertulis dari customer</small>
        </article>

    </section>


    
    <section class="admin-review-filter-card">
        <div class="admin-review-filter-head">
            <div>
                <span>Filter Ulasan</span>
                <h2>Pantau rating dan komentar customer</h2>
            </div>
        </div>

        <form method="GET" action="<?php echo e(route('admin.reviews.index')); ?>" class="admin-review-filter-form">

            <div class="admin-review-filter-field admin-review-filter-field--search">
                <label for="search">Cari Ulasan</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="<?php echo e($search); ?>"
                    placeholder="Nama customer, email, produk, atau isi komentar..."
                >
            </div>

            <div class="admin-review-filter-field">
                <label for="rating">Filter Rating</label>
                <select name="rating" id="rating">
                    <option value="">Semua Rating</option>
                    <option value="5" <?php echo e((string) $rating === '5' ? 'selected' : ''); ?>>5 Bintang</option>
                    <option value="4" <?php echo e((string) $rating === '4' ? 'selected' : ''); ?>>4 Bintang</option>
                    <option value="3" <?php echo e((string) $rating === '3' ? 'selected' : ''); ?>>3 Bintang</option>
                    <option value="2" <?php echo e((string) $rating === '2' ? 'selected' : ''); ?>>2 Bintang</option>
                    <option value="1" <?php echo e((string) $rating === '1' ? 'selected' : ''); ?>>1 Bintang</option>
                </select>
            </div>

            <div class="admin-review-filter-actions">
                <button type="submit" class="admin-review-btn admin-review-btn--primary">
                    <i class="bi bi-funnel"></i>
                    Terapkan Filter
                </button>

                <a href="<?php echo e(route('admin.reviews.index')); ?>" class="admin-review-btn admin-review-btn--ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </div>

        </form>
    </section>


    
    <section class="admin-review-table-card">
        <div class="admin-review-table-head">
            <div>
                <span>Daftar Ulasan</span>
                <h2>Rating & Komentar Customer</h2>
            </div>

            <div class="admin-review-result-pill">
                <?php echo e(number_format($reviews->total(), 0, ',', '.')); ?> data ditemukan
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
                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="admin-review-customer">
                                    <strong><?php echo e($review->user->name ?? 'User Tidak Ditemukan'); ?></strong>
                                    <span><?php echo e($review->user->email ?? '-'); ?></span>
                                </div>
                            </td>

                            <td>
                                <div class="admin-review-product">
                                    <strong><?php echo e($review->product->name ?? $review->orderItem->product_name_snapshot ?? '-'); ?></strong>
                                    <span>
                                        <?php echo e($review->orderItem->size_snapshot ?? '-'); ?>

                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="admin-review-rating">
                                    <div class="admin-review-stars">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="bi <?php echo e($i <= $review->rating ? 'bi-star-fill' : 'bi-star'); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <strong><?php echo e($review->rating); ?>/5</strong>
                                </div>
                            </td>

                            <td>
                                <?php if($review->comment): ?>
                                    <div class="admin-review-comment">
                                        <?php echo e($review->comment); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="admin-review-no-comment">Tanpa komentar</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e($review->created_at?->timezone('Asia/Jakarta')->format('d M Y, H:i')); ?> WIB
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="admin-review-empty">
                                    <i class="bi bi-chat-square-heart"></i>
                                    <strong>Belum ada ulasan yang sesuai.</strong>
                                    <span>Coba ubah filter atau tunggu customer memberi rating.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($reviews->hasPages()): ?>
            <div class="admin-review-pagination">
                <?php echo e($reviews->links()); ?>

            </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>