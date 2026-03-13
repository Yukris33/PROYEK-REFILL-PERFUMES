<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Models\Product;

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

Route::get('/voucher-bantuan', function () {
    return view('voucher-bantuan');
})->name('nav.voucher-bantuan');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

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

// CART
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

Route::post('/checkout/selected', [CartController::class, 'checkoutSelected'])->name('checkout.selected');