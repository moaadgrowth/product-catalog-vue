<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::inertia('/', 'Welcome')->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');