<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

//login / register customar route
Route::get("/login", function(){
    return redirect()->to('/');
})->name('login');
//{{-- Route::get("/register", function(){return redirect()->to('/');})->name('register'); --}}

Route::get("/home", [App\Http\Controllers\HomeController::class,"index",])->name("home");
Route::get("/customar/logout", [App\Http\Controllers\HomeController::class,"logout",])->name("customar.logout");

//frontend all route 
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function(){
    Route::get("/", 'IndexController@index');
    Route::get("/product-details/{slug}", 'IndexController@productdetails')->name('product.details');
    //product quick view
    Route::get("/quick-view/{id}", 'IndexController@productquickview');
    //add to cart quick view
    Route::post("/addtocart", 'AddToCartController@AddToCart')->name('add.to.cart.quickview');
    //cart total and qty
    Route::get("/allCart", 'AddToCartController@AllCart')->name('all.cart');
    //wishlist
    Route::get("/wishlist/add/{id}", 'AddToCartController@addwishlist')->name('add.wishlist');
    //review route
    Route::post("/review/store", 'ReviewController@store')->name('review.store');
});
