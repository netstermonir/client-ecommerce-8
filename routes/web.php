<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

Route::get("/home", [App\Http\Controllers\HomeController::class,"index",])->name("home");

//frontend all route 
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function(){
    Route::get("/", 'IndexController@index');
    Route::get("/product-details/{slug}", 'IndexController@productdetails')->name('product.details');
});
