<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use \App\Http\Controllers\CommentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [SettingController::class,'edit'])->name('settingShow');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class, 'update'])
    ->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/products/create' , [ProductController::class , 'create'] )->name('products.create');
});

Route::post('/blogs/{blog:slug}/comment',[CommentController::class, 'store'])->name('comments.store');
Route::get('/blogs/{blog:slug}', [BlogController::class,'show'])->name('blogs.show');
Route::get('/products/{product:slug}', [ProductController::class,'show'])->name('products.show');

Route::resource('/products' , ProductController::class )->except('show','index');
Route::resource('/blogs',BlogController::class)->except('show','index');

Route::get('/blogs', [BlogController::class,'index'])->name('blogs.index');
Route::get('/products', [ProductController::class,'index'])->name('products.index');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/tst', function () {
    return view('contact');
});

