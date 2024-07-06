<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\BlogController;
use \App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');


Route::post('/blogs/{blog:slug}/comment',[CommentController::class, 'store'])->name('comments.store');
Route::get('/blogs/{blog:slug}', [BlogController::class,'show'])->name('blogs.show');
Route::resources([
    'products' => ProductController::class ,
    'blogs' => BlogController::class ,
]);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tst', function () {
    return view('chackout');
});
//Route::get('/contact', function () {
//    return view('contact');
//});
