<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/parfum/refill', [ProductController::class, 'refill'])
  ->name('products.refill');