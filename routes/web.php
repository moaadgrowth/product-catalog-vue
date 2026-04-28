<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::inertia('/', 'Home')->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//Admin routes
Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::inertia('/', 'Admin/Dashboard')->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', AdminProductController::class)->except(['show']);
});

