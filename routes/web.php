<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


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
    require __DIR__.'/products.refill.php';
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



Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('cart', compact('cart'));
})->name('cart.index');

Route::post('/cart/add', function (Request $request) {
    $cart = session()->get('cart', []);
    $cartKey = $request->product_key . '_' . $request->size;

    if (isset($cart[$cartKey])) {
        $cart[$cartKey]['qty']++;
    } else {
        $cart[$cartKey] = [
            'product_key' => $request->product_key,
            'name' => $request->name,
            'image' => $request->image,
            'size' => $request->size,
            'price' => $request->price,
            'qty' => 1,
            'type' => $request->type,
        ];
    }

    session(['cart' => $cart]);

    return redirect()->route('cart.index');
})->name('cart.add');


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


//PREVIEW 

Route::get('/preview/prestige', function () {
    return view('preview.prestige');
})->name('preview.prestige');

