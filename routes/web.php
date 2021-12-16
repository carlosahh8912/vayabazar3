<?php

use App\Http\Livewire\Sales;
use App\Http\Livewire\Stores;
use App\Http\Livewire\Products;
use App\Http\Livewire\Customers;
use App\Http\Livewire\BrandController;
use App\Http\Livewire\Shippings;
use App\Http\Livewire\Users;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('stores', Stores::class)->name('stores')->middleware('auth');
Route::get('brands', BrandController::class)->name('brands')->middleware('auth');
Route::get('products', Products::class)->name('products')->middleware('auth');
Route::get('customers', Customers::class)->name('customers')->middleware('auth');
Route::get('sales', Sales::class)->name('sales')->middleware('auth');
Route::get('sale/create', Sales::class)->name('sale/create')->middleware('auth');
Route::get('users', Users::class)->name('users')->middleware('auth');
Route::get('shippings', Shippings::class)->name('shippings')->middleware('auth');
