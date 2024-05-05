<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\product_listController;
use App\Http\Controllers\product_detailController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\cartController;

Route::get('/', [indexController::class, 'index'])->name('index');
// ACCOUNT
Route::get('/account/{user}/', [accountController::class, 'account'])->name('account');

Route::post('/account/{user}/updateAccount', [accountController::class, 'updateAccount'])->name('updateAccount');


// CART
Route::get('/cart', [cartController::class, 'cart'])->name('cart');
Route::get('/cart/{cart}', [cartController::class, 'userCart'])->name('userCart');


// PRODUCT DETAIL

Route::get('/product/{product_id:uuid}', [product_detailController::class, 'detail'])->name('productDetail');
Route::post('/product/{product_id:uuid}/addToCart', [product_detailController::class, 'addToCart'])->name('addToCart');


// PRODUCT LIST

Route::get('/products/{page}{request?}', [product_listController::class, 'index'])->name('products');

// SEARCH PRODUCT LIST
Route::get('/products/{page}{search?}', [product_listController::class, 'searchProduct'])->name('searchProduct');

// FILTER PRODUCT LIST
Route::get('/products/
{page}
{filter-range-price-min?}
{filter-range-price-max?}
{product-list-order-by?}
{category?}
{series?}', [product_listController::class, 'filterProduct'])->name('filterProduct');

//filter-range-price-min=0 & filter-range-price-max=5 & product-list-order-by=pri_hi_lo
// & category=Manga & category=Box+Set
// & series=Orange & series=Erased


// ADD PRODUCT
Route::get('/products/addProduct', [product_listController::class, 'addProduct'])->name('addProduct');
Route::post('/products/addProduct', [product_listController::class, 'addProduct'])->name('addProduct');

// ADD CATEGORY
Route::get('/products/addCategory', [product_listController::class, 'addCategory'])->name('addCategory');
Route::post('/products/addCategory', [product_listController::class, 'addCategory'])->name('addCategory');

// ADD SERIES
Route::get('/products/addSeries', [product_listController::class, 'addSeries'])->name('addSeries');
Route::post('/products/addSeries', [product_listController::class, 'addSeries'])->name('addSeries');

// EDIT PRODUCT / DELETE
//Route::get('/product_list/{page}/editProduct{product_id?}{category-select?}{series-select?}{action?}', [product_listController::class, 'editProduct'])->name('editProduct');
//Route::post('/product_list/{page}/editProduct{product_id?}{category-select?}{series-select?}{action?}', [product_listController::class, 'editProduct'])->name('editProduct');

Route::get('/products/editProduct', [product_listController::class, 'editProduct'])->name('editProduct');
Route::post('/products/editProduct', [product_listController::class, 'editProduct'])->name('editProduct');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
