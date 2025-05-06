<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [dashboard::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('items', ItemController::class);
Route::resource('transactions', TransactionController::class);
