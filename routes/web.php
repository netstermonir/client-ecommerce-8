<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

//login / register customar route
Route::get("/login", function(){
    return redirect()->to('/');
})->name('login');
Route::get("/register", function(){
    return redirect()->to('/');
})->name('register');

Route::get("/home", [App\Http\Controllers\HomeController::class,"index",])->name("home");
Route::get("/customar/logout", [App\Http\Controllers\HomeController::class,"logout",])->name("customar.logout");

//frontend all route 
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function(){
    Route::get("/", 'IndexController@index');
    Route::get("/product-details/{slug}", 'IndexController@productdetails')->name('product.details');
    //review route
    Route::post("/review/store", 'ReviewController@store')->name('review.store');
});
