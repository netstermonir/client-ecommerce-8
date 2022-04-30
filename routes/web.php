<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

//login / register customar route
Route::get("/login", function () {
    return redirect()->to("/");
})->name("login");
//{{-- Route::get("/register", function(){return redirect()->to('/');})->name('register'); --}}

// user profile
Route::get("/profile", [
    App\Http\Controllers\HomeController::class,
    "index",
])->name("profile");

Route::get("/customar/logout", [
    App\Http\Controllers\HomeController::class,
    "logout",
])->name("customar.logout");

//frontend all route
Route::group(["namespace" => 'App\Http\Controllers\frontend'], function () {
    Route::get("/", "IndexController@index");
    Route::get(
        "/product-details/{slug}",
        "IndexController@productdetails"
    )->name("product.details");
    //product quick view
    Route::get("/quick-view/{id}", "IndexController@productquickview");
    //add to cart quick view
    Route::post("/addtocart", "AddToCartController@AddToCart")->name(
        "add.to.cart.quickview"
    );
    //cart total and qty
    Route::get("/allCart", "AddToCartController@AllCart")->name("all.cart");
    //cart product remove
    Route::get(
        "/cartproduct/remove/{rowId}",
        "AddToCartController@RemoveProduct"
    );
    // Cart product update
    Route::get(
        "/cartproduct/updateqty/{qty}/{rowId}",
        "AddToCartController@CarProductqty"
    );
    Route::get(
        "/cartproduct/updatesize/{size}/{rowId}",
        "AddToCartController@CarProductsize"
    );
    Route::get(
        "/cartproduct/updatecolor/{color}/{rowId}",
        "AddToCartController@CarProductcolor"
    );
    Route::get("/CartPage", "AddToCartController@MyCart")->name("cart.page");
    Route::get("/CartClear", "AddToCartController@CartEmpty")->name(
        "cart.empty"
    );
    //wishlist
    Route::get("/wishlist/add/{id}", "AddToCartController@addwishlist")->name(
        "add.wishlist"
    );
    Route::get("/wishlistPage", "AddToCartController@whitelistPage")->name(
        "wishlist.page"
    );
    Route::get("/wishlistClear", "AddToCartController@whitelistEmpty")->name(
        "wishlist.empty"
    );
    Route::get(
        "/wishlist/product/delete/{id}",
        "AddToCartController@whitelistdelete"
    )->name("whishlistproduct.delete");
    //review route for product
    Route::post("/review/store", "ReviewController@store")->name(
        "review.store"
    );
    //category wise product show
    Route::get(
        "/categorywise/product/{id}",
        "IndexController@CategoryWise"
    )->name("categorywise.product");
    Route::get(
        "/subcategorywise/product/{id}",
        "IndexController@SubCategoryWise"
    )->name("subcategorywise.product");
    Route::get(
        "/childcategorywise/product/{id}",
        "IndexController@ChildCategoryWise"
    )->name("childcategorywise.product");
    //brand wise product show
    Route::get(
        "/brandcategorywise/product/{id}",
        "IndexController@BandCategoryWise"
    )->name("brandwise.product");
    // customer profile route
    Route::get("website/review", "ProfileController@websiteReview")->name(
        "write.review"
    );
    Route::post("website/review/store", "ProfileController@Review")->name(
        "websitereview.store"
    );
    Route::get("customer/setting", "ProfileController@CustomerSetting")->name(
        "customar.setting"
    );
    Route::post(
        "customer/password/change",
        "ProfileController@passwordChange"
    )->name("customar.passwordChange");
});
