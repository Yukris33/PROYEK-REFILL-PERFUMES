<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

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