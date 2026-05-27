<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use App\Http\Controllers\BottleReturnController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\VoucherBantuanController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminVendingMachineController;
use App\Http\Controllers\Admin\AdminVoucherPointController;
use App\Http\Controllers\Admin\AdminSupportTicketController;
use App\Http\Controllers\Admin\AdminPartnershipController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBottleRecycleController;

Route::get('/refill', function () {
    $sort = request('sort', 'popular');

    $products = new LengthAwarePaginator([], 0, 12, 1, [
        'path' => request()->url(),
        'query' => request()->query(),
    ]);

    return view('refill', compact('products', 'sort'));
})->name('products.refill');

Route::get('/brand', function () {
    $sort = request('sort', 'popular');

    $products = new LengthAwarePaginator([], 0, 12, 1, [
        'path' => request()->url(),
        'query' => request()->query(),
    ]);

    return view('refill', compact('products', 'sort'));
})->name('nav.brand');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('parfum')->group(function () {
    require __DIR__ . '/products.refill.php';
});

Route::get('/botol', function () {
    $sort = request('sort', 'popular');

    $products = new LengthAwarePaginator([], 0, 12, 1, [
        'path' => request()->url(),
        'query' => request()->query(),
    ]);

    return view('botol', compact('products', 'sort'));
})->name('products.botol');

Route::get('/vending-machine-place', function () {
    return view('vending-place');
})->name('vending.place');

Route::get('/voucher-bantuan', [VoucherBantuanController::class, 'index'])
    ->name('nav.voucher-bantuan');

Route::post('/voucher-bantuan/voucher/{voucher}/claim', [VoucherBantuanController::class, 'claimVoucher'])
    ->middleware('auth')
    ->name('voucher.claim');

Route::post('/voucher-bantuan/kendala', [VoucherBantuanController::class, 'storeTicket'])
    ->name('support.ticket.store');

Route::post('/voucher-bantuan/kerja-sama', [VoucherBantuanController::class, 'storePartnership'])
    ->name('partnership.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])
    ->name('admin.login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
        ->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// PREVIEW
Route::get('/preview/prestige', function () {
    return view('preview.prestige');
})->name('preview.prestige');

Route::get('/preview/ocean', function () {
    return view('preview.ocean');
})->name('preview.ocean');

Route::get('/preview/midnight', function () {
    return view('preview.midnight');
})->name('preview.midnight');

Route::get('/preview/citrus', function () {
    return view('preview.citrus');
})->name('preview.citrus');

Route::get('/preview/velvet', function () {
    return view('preview.velvet');
})->name('preview.velvet');

Route::get('/preview/vanilla', function () {
    return view('preview.vanilla');
})->name('preview.vanilla');

Route::get('/preview/silver', function () {
    return view('preview.silver');
})->name('preview.silver');

Route::get('/preview/blue', function () {
    return view('preview.blue');
})->name('preview.blue');

Route::get('/preview/emerald', function () {
    return view('preview.emerald');
})->name('preview.emerald');

Route::post('/cart/buy-now', [CartController::class, 'buyNow'])
    ->name('cart.buyNow');

    Route::get('/status-pesanan/{orderCode}/refresh-payment', [CheckoutController::class, 'refreshPaymentStatus'])
    ->name('orders.refreshPayment');

// CART
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

// Jangan dipakai dulu, karena method checkoutSelected belum ada
// Route::post('/checkout/selected', [CartController::class, 'checkoutSelected'])->name('checkout.selected');

// CHECKOUT
Route::get('/checkout', [CheckoutController::class, 'show'])
    ->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/status-pesanan/{orderCode}', [CheckoutController::class, 'status'])
    ->name('orders.status');

   Route::get('/preview/bottle/{slug}', function ($slug) {
    $bottles = [
        'travel-bottle-clear' => [
            'slug' => 'travel-bottle-clear',
            'kicker' => 'TRAVEL CLEAR',
            'name' => 'SCENTC Travel Bottle Clear',
            'image' => 'img/100ml.png',
            'category' => 'bottle',
            'character' => 'Portable · Clear · Lightweight',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol parfum travel yang ringan, bening, dan praktis dibawa untuk kebutuhan refill harian.',
            'description2' => 'Cocok untuk pengguna yang ingin membawa parfum dalam ukuran kecil tanpa membawa botol utama.',
            'sizes' => [
                10 => 15000,
                30 => 25000,
                50 => 35000,
            ],
        ],

        'minimal-frost-bottle' => [
            'slug' => 'minimal-frost-bottle',
            'kicker' => 'MINIMAL GLASS',
            'name' => 'SCENTC Minimal Frost Bottle',
            'image' => 'img/botol polosan2.png',
            'category' => 'bottle',
            'character' => 'Minimal · Frosted · Clean',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol kaca frosted dengan tampilan minimal dan modern untuk pengalaman refill yang lebih premium.',
            'description2' => 'Material kaca memberi kesan elegan dan cocok untuk pengguna yang menyukai visual botol parfum yang clean.',
            'sizes' => [
                20 => 22000,
                30 => 30000,
                50 => 42000,
            ],
        ],

        'premium-spray-bottle' => [
            'slug' => 'premium-spray-bottle',
            'kicker' => 'PREMIUM SPRAY',
            'name' => 'SCENTC Premium Spray Bottle',
            'image' => 'img/1100ml.png',
            'category' => 'bottle',
            'character' => 'Premium · Elegant · Daily Use',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol spray premium dengan tampilan elegan untuk pengalaman refill parfum yang lebih eksklusif.',
            'description2' => 'Pilihan ideal untuk pengguna yang ingin botol parfum praktis namun tetap terlihat premium.',
            'sizes' => [
                30 => 35000,
                50 => 50000,
                100 => 75000,
            ],
        ],

        'matte-black-bottle' => [
            'slug' => 'matte-black-bottle',
            'kicker' => 'MATTE BLACK',
            'name' => 'SCENTC Matte Black Bottle',
            'image' => 'img/b1.png',
            'category' => 'bottle',
            'character' => 'Bold · Dark · Modern',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill matte black dengan nuansa maskulin, modern, dan tampilan minimalis.',
            'description2' => 'Cocok untuk pengguna yang menyukai desain gelap, simpel, dan premium.',
            'sizes' => [
                10 => 18000,
                20 => 26000,
                30 => 35000,
            ],
        ],

        'classic-round-bottle' => [
            'slug' => 'classic-round-bottle',
            'kicker' => 'CLASSIC ROUND',
            'name' => 'SCENTC Classic Round Bottle',
            'image' => 'img/b2.png',
            'category' => 'bottle',
            'character' => 'Classic · Rounded · Timeless',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill berbentuk bulat klasik dengan desain timeless yang cocok untuk berbagai karakter parfum.',
            'description2' => 'Memberikan tampilan elegan dengan bentuk yang nyaman digenggam.',
            'sizes' => [
                30 => 30000,
                50 => 45000,
                70 => 60000,
            ],
        ],

        'crystal-glass-bottle' => [
            'slug' => 'crystal-glass-bottle',
            'kicker' => 'CRYSTAL CLEAR',
            'name' => 'SCENTC Crystal Glass Bottle',
            'image' => 'img/b3.png',
            'category' => 'bottle',
            'character' => 'Clear · Refined · Luxury',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol kaca bening bergaya crystal look dengan kesan bersih dan eksklusif.',
            'description2' => 'Cocok untuk koleksi parfum yang ingin ditampilkan lebih mewah dan elegan.',
            'sizes' => [
                50 => 55000,
                100 => 85000,
            ],
        ],

        'soft-pink-bottle' => [
            'slug' => 'soft-pink-bottle',
            'kicker' => 'SOFT PINK',
            'name' => 'SCENTC Soft Pink Bottle',
            'image' => 'img/b4.png',
            'category' => 'bottle',
            'character' => 'Soft · Chic · Feminine',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill bernuansa soft pink dengan visual manis dan elegan.',
            'description2' => 'Pilihan cocok untuk pengguna yang menyukai desain ringan, stylish, dan lembut.',
            'sizes' => [
                10 => 18000,
                20 => 26000,
                30 => 35000,
            ],
        ],

        'ocean-blue-bottle' => [
            'slug' => 'ocean-blue-bottle',
            'kicker' => 'OCEAN BLUE',
            'name' => 'SCENTC Ocean Blue Bottle',
            'image' => 'img/b5.png',
            'category' => 'bottle',
            'character' => 'Fresh · Blue · Clean',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill berwarna ocean blue dengan karakter fresh dan modern.',
            'description2' => 'Memberikan nuansa clean dan cocok untuk parfum dengan karakter aquatic atau sporty.',
            'sizes' => [
                20 => 25000,
                30 => 35000,
                50 => 50000,
            ],
        ],

        'rectangle-glass-bottle' => [
            'slug' => 'rectangle-glass-bottle',
            'kicker' => 'RECTANGLE GLASS',
            'name' => 'SCENTC Rectangle Glass Bottle',
            'image' => 'img/b6.png',
            'category' => 'bottle',
            'character' => 'Sharp · Structured · Premium',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol kaca persegi dengan tampilan tegas, clean, dan premium.',
            'description2' => 'Desainnya cocok untuk konsep parfum yang lebih formal dan eksklusif.',
            'sizes' => [
                30 => 40000,
                50 => 55000,
                100 => 90000,
            ],
        ],

        'pocket-mini-bottle' => [
            'slug' => 'pocket-mini-bottle',
            'kicker' => 'POCKET MINI',
            'name' => 'SCENTC Pocket Mini Bottle',
            'image' => 'img/b7.png',
            'category' => 'bottle',
            'character' => 'Mini · Portable · Everyday',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol mini yang praktis masuk saku dan cocok untuk mobilitas harian.',
            'description2' => 'Pilihan ideal untuk touch-up parfum cepat saat bepergian.',
            'sizes' => [
                10 => 12000,
                15 => 16000,
                20 => 20000,
            ],
        ],

        'amber-refill-bottle' => [
            'slug' => 'amber-refill-bottle',
            'kicker' => 'AMBER GLASS',
            'name' => 'SCENTC Amber Refill Bottle',
            'image' => 'img/bottle11.png',
            'category' => 'bottle',
            'character' => 'Warm · Vintage · Elegant',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill amber glass dengan nuansa hangat dan lebih klasik.',
            'description2' => 'Tampilannya cocok untuk parfum bernuansa woody, oriental, atau spicy.',
            'sizes' => [
                30 => 35000,
                50 => 50000,
                100 => 80000,
            ],
        ],

        'signature-white-bottle' => [
            'slug' => 'signature-white-bottle',
            'kicker' => 'SIGNATURE WHITE',
            'name' => 'SCENTC Signature White Bottle',
            'image' => 'img/bottle12.png',
            'category' => 'bottle',
            'character' => 'Clean · Signature · Modern',
            'type' => 'Empty Refill Bottle',
            'description' => 'Botol refill warna putih bersih dengan nuansa signature yang modern.',
            'description2' => 'Cocok untuk tampilan parfum yang minimal, rapi, dan premium.',
            'sizes' => [
                20 => 30000,
                30 => 42000,
                50 => 60000,
            ],
        ],
    ];

    abort_if(!isset($bottles[$slug]), 404);

    return view('preview.bottle', [
        'bottle' => $bottles[$slug],
    ]);
})->name('preview.bottle');

Route::middleware('auth')->group(function () {
    Route::get('/return-botol', [BottleReturnController::class, 'show'])
        ->name('return.botol');

    Route::post('/return-botol', [BottleReturnController::class, 'store'])
        ->name('return.botol.store');

    Route::get('/return-botol/status/{returnCode}', [BottleReturnController::class, 'status'])
        ->name('return.botol.status');

    Route::post('/return-botol/status/{returnCode}/success', [BottleReturnController::class, 'markSuccess'])
        ->name('return.botol.success');

    Route::post('/return-botol/status/{returnCode}/failed', [BottleReturnController::class, 'markFailed'])
        ->name('return.botol.failed');
});

Route::middleware('auth')->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');
});

Route::post('/voucher-bantuan/voucher/{voucher}/check-stock', [VoucherBantuanController::class, 'checkVoucherStock'])
    ->middleware('auth')
    ->name('voucher.check-stock');

Route::post('/reviews/{orderItem}', [ProductReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.orders.index');

    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])
    ->middleware(['auth', 'admin'])
    ->name('admin.orders.show');

    Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
    ->middleware(['auth', 'admin'])
    ->name('admin.orders.update-status');

    Route::get('/admin/reviews', [AdminReviewController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.reviews.index');

    Route::get('/admin/vending-machines', [AdminVendingMachineController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vending.index');

    Route::post('/admin/vending-machines/refill-scent', [AdminVendingMachineController::class, 'refillScent'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vending.refill-scent');

Route::post('/admin/vending-machines/add-empty-bottle', [AdminVendingMachineController::class, 'addEmptyBottle'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vending.add-empty-bottle');

Route::post('/admin/vending-machines/collect-returned-bottle', [AdminVendingMachineController::class, 'collectReturnedBottle'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vending.collect-returned-bottle');

Route::post('/admin/vending-machines/maintenance', [AdminVendingMachineController::class, 'storeMaintenance'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vending.maintenance');

Route::get('/admin/vouchers-points', [AdminVoucherPointController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vouchers.index');

    Route::post('/admin/vouchers-points', [AdminVoucherPointController::class, 'store'])
    ->middleware(['auth', 'admin'])
    ->name('admin.vouchers.store');

    Route::get('/admin/support-tickets', [AdminSupportTicketController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.support-tickets.index');

Route::patch('/admin/support-tickets/{ticket}/status', [AdminSupportTicketController::class, 'updateStatus'])
    ->middleware(['auth', 'admin'])
    ->name('admin.support-tickets.update-status');


Route::get('/admin/partnerships', [AdminPartnershipController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.partnerships.index');

Route::patch('/admin/partnerships/{partnership}/status', [AdminPartnershipController::class, 'updateStatus'])
    ->middleware(['auth', 'admin'])
    ->name('admin.partnerships.update-status');


Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.users.index');

Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
    ->middleware(['auth', 'admin'])
    ->name('admin.users.update-role');

    Route::get('/admin/recycle-bottles', [AdminBottleRecycleController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.recycle-bottles.index');

Route::post('/admin/recycle-bottles/process', [AdminBottleRecycleController::class, 'process'])
    ->middleware(['auth', 'admin'])
    ->name('admin.recycle-bottles.process');