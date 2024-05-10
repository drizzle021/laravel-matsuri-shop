<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product_listController;
use App\Http\Controllers\product_detailController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutController;

Route::get('/', [indexController::class, 'index'])->name('index');
// ACCOUNT
Route::get('/account/{user}/', [accountController::class, 'account'])->name('account');

Route::post('/account/{user}/updateAccount', [accountController::class, 'updateAccount'])->name('updateAccount');


// CART
Route::get('/cart', [cartController::class, 'cart'])->name('cart');
Route::get('/cart/{cart}', [cartController::class, 'userCart'])->name('userCart');

Route::post('/cart/{cart}/updateCart', [cartController::class, 'updateCart'])->name('updateCart');

// CHECKOUT

Route::get('/cart/{cart}/checkout', [checkoutController::class, 'checkout'])->name('checkout');

Route::post('/cart/{cart}/checkout/sendOrder', [checkoutController::class, 'sendOrder'])->name('sendOrder');


// PRODUCT DETAIL

Route::get('/product/{product_id:uuid}', [product_detailController::class, 'detail'])->name('productDetail');
Route::post('/product/{product_id:uuid}/addToCart', [product_detailController::class, 'addToCart'])->name('addToCart');


// PRODUCT LIST

Route::get('/products/list', [product_listController::class, 'index'])->name('products');



// SEARCH PRODUCT LIST
Route::get('/products/list{search?}', [product_listController::class, 'searchProduct'])->name('searchProduct');

// FILTER PRODUCT LIST
Route::get('/products/list{filter-range-price-min?}{filter-range-price-max?}{product-list-order-by?}{category?}{series?}', [product_listController::class, 'filterProduct'])->name('filterProduct');

// ADD PRODUCT
Route::get('/products/addProduct', [product_listController::class, 'addProduct'])->name('addProduct');
Route::post('/products/addProduct', [product_listController::class, 'addProduct'])->name('addProduct');

// ADD CATEGORY
Route::get('/products/addCategory', [product_listController::class, 'addCategory'])->name('addCategory');
Route::post('/products/addCategory', [product_listController::class, 'addCategory'])->name('addCategory');

// ADD SERIES
Route::get('/products/addSeries', [product_listController::class, 'addSeries'])->name('addSeries');
Route::post('/products/addSeries', [product_listController::class, 'addSeries'])->name('addSeries');


Route::get('/products/editProduct', [product_listController::class, 'editProduct'])->name('editProduct');
Route::post('/products/editProduct', [product_listController::class, 'editProduct'])->name('editProduct');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
