<?php

use Illuminate\Support\Facades\Route;

Route::get("/admin/login", [
    App\Http\Controllers\Auth\LoginController::class,
    "adminLogin",
])->name("admin.login");

//auth route
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function() {
    Route::get("/admin/home", "AdminController@admin")->name("admin.home");
    Route::get("/admin/logout", "AdminController@logout")->name("admin.logout");
    Route::get("/admin/password/change", "AdminController@passwordChange")->name("admin.password.change");
    Route::post("/admin/password/update", "AdminController@passwordUpdate")->name("admin.password.update");

    //Main Category Route
    Route::group(['prefix' => 'category'], function() {
        Route::get("/", "CategoryController@index")->name("category.index");
        Route::post("/store", "CategoryController@store")->name("category.store");
        Route::get("/delete/{id}", "CategoryController@destroy")->name("category.delete");
        Route::get("/edit/{id}", "CategoryController@edit");
        Route::post("/update", "CategoryController@update")->name("category.update");
    });

    //SubCategory Route
    Route::group(['prefix' => 'subcategory'], function() {
        Route::get("/", "SubcategoryController@index")->name("subcategory.index");
        Route::post("/store", "SubcategoryController@store")->name("subcategory.store");
        Route::get("/delete/{id}", "SubcategoryController@destroy")->name("subcategory.delete");
        Route::get("/edit/{id}", "SubcategoryController@edit");
        Route::post("/update", "SubcategoryController@update")->name("subcategory.update");
    });

    //ChildCategory Route
    Route::group(['prefix' => 'childcategory'], function() {
        Route::get("/", "ChildcategoryController@index")->name("childcategory.index");
        Route::post("/store", "ChildcategoryController@store")->name("childcategory.store");
        Route::get("/delete/{id}", "ChildcategoryController@destroy")->name("childcategory.delete");
        Route::get("/edit/{id}", "ChildcategoryController@edit");
        Route::post("/update", "ChildcategoryController@update")->name("childcategory.update");
    });

    //Brand Route
    Route::group(['prefix' => 'brand'], function() {
        Route::get("/", "BrandController@index")->name("brand.index");
        Route::post("/store", "BrandController@store")->name("brand.store");
        Route::get("/delete/{id}", "BrandController@destroy")->name("brand.delete");
        Route::get("/edit/{id}", "BrandController@edit");
        Route::post("/update", "BrandController@update")->name("brand.update");
    });

    //Warehouse Route
    Route::group(['prefix' => 'warehouse'], function() {
        Route::get("/", "WarehouseController@index")->name("warehouse.index");
        Route::post("/store", "WarehouseController@store")->name("warehouse.store");
        Route::get("/delete/{id}", "WarehouseController@destroy")->name("warehouse.delete");
        Route::get("/edit/{id}", "WarehouseController@edit");
        Route::post("/update", "WarehouseController@update")->name("warehouse.update");
    });

    //cupon Route
    Route::group(['prefix' => 'cupon'], function() {
        Route::get("/", "CuponController@index")->name("cupon.index");
        Route::post("/store", "CuponController@store")->name("cupon.store");
        Route::delete('/delete/{id}','CuponController@destroy')->name('coupon.delete');
        Route::get("/edit/{id}", "CuponController@edit");
        Route::post("/update", "CuponController@update")->name("cupon.update");
    });

    //pickup point Route
    Route::group(['prefix' => 'pickup-point'], function() {
        Route::get("/", "PickupController@index")->name("pickuppoint.index");
        Route::post("/store", "PickupController@store")->name("pickuppoint.store");
        Route::delete('/delete/{id}','PickupController@destroy')->name('pickuppoint.delete');
        Route::get("/edit/{id}", "PickupController@edit");
        Route::post("/update", "PickupController@update")->name("pickuppoint.update");
    });

    //setting Route
    Route::group(['prefix' => 'setting'], function() {
        // seo setting
        Route::group(['prefix' => 'seo'], function() {
            Route::get("/", "SettingController@seo")->name("seo.setting");
            Route::post("/update/{id}", "SettingController@seoUpdate")->name("seo.setting.update");
        });
        // smtp setting
        Route::group(['prefix' => 'smtp'], function() {
            Route::get("/", "SettingController@smtp")->name("smtp.setting");
            Route::post("/update/{id}", "SettingController@smtpUpdate")->name("smtp.setting.update");
        });
        // website setting
        Route::group(['prefix' => 'website'], function() {
            Route::get("/", "SettingController@website")->name("website.setting");
            Route::post("/update/{id}", "SettingController@websiteUpdate")->name("website.setting.update");
        });
        //page setting
        Route::group(['prefix' => 'page'], function() {
            Route::get("/", "PageController@index")->name("page.index");
            Route::get("/create", "PageController@create")->name("page.create");
            Route::post("/store", "PageController@store")->name("page.store");
            Route::get("/delete/{id}", "PageController@destroy")->name("page.delete");
            Route::get("/edit/{id}", "PageController@edit")->name("page.edit");
            Route::post("/update/{id}", "PageController@pageUpdate")->name("page.update");
        });
    });
});