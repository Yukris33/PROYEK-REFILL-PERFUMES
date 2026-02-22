<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;

Route::get('/refill', function () {

    $sort = request('sort', 'popular'); // <-- tambahin ini

    $products = new LengthAwarePaginator([], 0, 12, 1, [
        'path' => request()->url(),
        'query' => request()->query(),
    ]);

    return view('refill', compact('products', 'sort')); // <-- tambahin sort
})->name('products.refill');

Route::get('/', function () {
    return redirect()->route('products.refill');
});

Route::prefix('parfum')->group(function () {
    require __DIR__.'/products.refill.php';
});