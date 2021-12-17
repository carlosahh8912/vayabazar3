<?php

use App\Http\Livewire\Sales;
use App\Http\Livewire\Users;
use App\Http\Livewire\Stores;
use App\Http\Livewire\NewSale;
use App\Http\Livewire\Products;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Shippings;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BrandController;

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('stores', Stores::class)->name('stores')->middleware('auth');
Route::get('brands', BrandController::class)->name('brands')->middleware('auth');
Route::get('products', Products::class)->name('products')->middleware('auth');
Route::get('customers', Customers::class)->name('customers')->middleware('auth');
Route::get('sales', Sales::class)->name('sales')->middleware('auth');
Route::get('sales/create', NewSale::class)->name('sales.create')->middleware('auth');
Route::get('users', Users::class)->name('users')->middleware('auth');
Route::get('shippings', Shippings::class)->name('shippings')->middleware('auth');
