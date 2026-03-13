

<?php $__env->startSection('title', 'Voucher & Bantuan - SCENTCYCLE'); ?>

<?php $__env->startSection('content'); ?>
<div data-page-css="<?php echo e(asset('css/voucher-bantuan.css')); ?>"></div>

<section class="voucher-help-page">
    <div class="container py-5">
        <div class="vh-hero text-center mb-5">
            <span class="vh-badge">SCENTCYCLE SERVICE</span>
            <h1 class="vh-title">Voucher & Bantuan</h1>
            <p class="vh-subtitle">
                Klaim voucher, laporkan kendala, dan hubungi kami untuk kerja sama
                dalam satu halaman yang lebih praktis.
            </p>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-7">
                <div class="vh-card vh-card-lg">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                        <div>
                            <h2 class="vh-section-title mb-1">Klaim Voucher</h2>
                            <p class="vh-section-desc mb-0">
                                Tukarkan poin Anda dengan promo menarik dari SCENTCYCLE.
                            </p>
                        </div>

                        <div class="vh-point-box">
                            <span class="vh-point-label">Saldo Poin Anda</span>
                            <strong class="vh-point-value">200 Poin</strong>
                        </div>
                    </div>

                    <div class="vh-voucher-list">
                        <div class="vh-voucher-item">
                            <div class="vh-voucher-icon"><i class="bi bi-stars"></i></div>
                            <div class="vh-voucher-content">
                                <h3>Diskon Refill 25%</h3>
                                <p>Potongan harga untuk 1x transaksi refill parfum.</p>
                            </div>
                            <div class="vh-voucher-meta">
                                <span class="vh-price">100 Poin</span>
                                <button class="vh-btn-primary">Klaim Voucher</button>
                            </div>
                        </div>

                        <div class="vh-voucher-item">
                            <div class="vh-voucher-icon"><i class="bi bi-droplet-half"></i></div>
                            <div class="vh-voucher-content">
                                <h3>Free Refill 1x</h3>
                                <p>Dapatkan refill gratis untuk 1 botol ukuran tertentu.</p>
                            </div>
                            <div class="vh-voucher-meta">
                                <span class="vh-price">250 Poin</span>
                                <button class="vh-btn-primary">Klaim Voucher</button>
                            </div>
                        </div>

                        <div class="vh-voucher-item">
                            <div class="vh-voucher-icon"><i class="bi bi-gift"></i></div>
                            <div class="vh-voucher-content">
                                <h3>Bonus 50 Poin</h3>
                                <p>Tambahan poin untuk digunakan pada transaksi berikutnya.</p>
                            </div>
                            <div class="vh-voucher-meta">
                                <span class="vh-price">150 Poin</span>
                                <button class="vh-btn-primary">Klaim Voucher</button>
                            </div>
                        </div>

                        <div class="vh-voucher-item">
                            <div class="vh-voucher-icon"><i class="bi bi-ticket-perforated"></i></div>
                            <div class="vh-voucher-content">
                                <h3>Gift Voucher Rp20.000</h3>
                                <p>Voucher belanja yang bisa dipakai untuk produk tertentu.</p>
                            </div>
                            <div class="vh-voucher-meta">
                                <span class="vh-price">300 Poin</span>
                                <button class="vh-btn-primary">Klaim Voucher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">
                    
                    <div class="vh-card">
                        <div class="vh-side-icon danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <h2 class="vh-section-title">Ada Kendala?</h2>
                        <p class="vh-section-desc">
                            Laporkan masalah pada mesin, transaksi, voucher, atau kendala lain
                            agar tim kami bisa segera membantu.
                        </p>

                        <div class="d-flex gap-2 flex-wrap mt-3">
                            <a href="#" class="vh-btn-primary">Buat Laporan</a>
                            <a href="#" class="vh-btn-secondary">Riwayat Laporan</a>
                        </div>
                    </div>

                    
                    <div class="vh-card">
                        <div class="vh-side-icon warning">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <h2 class="vh-section-title">Kerja Sama</h2>
                        <p class="vh-section-desc">
                            Tertarik menghadirkan mesin SCENTCYCLE di lokasi Anda atau ingin
                            menjadi mitra? Hubungi kami untuk diskusi lebih lanjut.
                        </p>

                        <div class="mt-3">
                            <a href="#" class="vh-btn-primary">Hubungi Kami</a>
                        </div>
                    </div>

                    
                    <div class="vh-card vh-soft-card">
                        <h3 class="vh-mini-title">Kenapa halaman ini dibuat terpisah?</h3>
                        <p class="mb-0">
                            Supaya user lebih gampang akses fitur voucher, bantuan, dan kerja sama
                            tanpa nyampur dengan katalog parfum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\XAMPP 2\htdocs\perfume-projek\resources\views/voucher-bantuan.blade.php ENDPATH**/ ?>