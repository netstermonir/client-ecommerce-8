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
    Route::get("my/order", "ProfileController@myOrder")->name("myorder");
    Route::post("website/review/store", "ProfileController@Review")->name(
        "websitereview.store"
    );
    Route::get("customer/setting", "ProfileController@CustomerSetting")->name(
        "customar.setting"
    );
    Route::get("view/order/{id}", "ProfileController@ViewOrder")->name(
        "view.order"
    );
    Route::post(
        "customer/password/change",
        "ProfileController@passwordChange"
    )->name("customar.passwordChange");
    //page view route
    Route::get("page/view/{page_slug}", "IndexController@viewPage")->name(
        "view.page"
    );
    // newsletter route
    Route::post("newsletter", "IndexController@Newsletter")->name(
        "newsletter.store"
    );
    //checkout route
    Route::get("page/checkout", "CheckoutController@Checkout")->name(
        "checkout"
    );
    //apply coupon check
    Route::post("apply/coupon", "CheckoutController@Coupon")->name(
        "apply.coupon"
    );
    //coupon remove coupon.remove
    Route::get("coupon/remove", "CheckoutController@Couponremove")->name(
        "coupon.remove"
    );
    // order place route and payment
    Route::post("order/place", "CheckoutController@orderPlcae")->name(
        "order.place"
    );
    //support tricket
    Route::get("open/tricket", "ProfileController@tricket")->name("open.tricket");
    Route::get("write/tricket", "ProfileController@Writetricket")->name("write.tricket");
    Route::post("submit/tricket", "ProfileController@submitTricket")->name("tricket.store");
    Route::get("show/tricket/{id}", "ProfileController@Showtricket")->name("show.tricket");
    Route::post("reply/tricket/", "ProfileController@Replytricket")->name("reply.ticket");
    //order tracking route
    Route::get("order/tracking", "IndexController@OrderTracking")->name("order.tracking");
    Route::post("order/track", "IndexController@OrderTrack")->name("track.order");
    //aamarpay getway routes
    Route::post('/success','CheckoutController@success')->name('success');
    Route::post('/fail','CheckoutController@fail')->name('fail');
    Route::post('order/cancel/', function(){
        return redirect()->to('/');
    })->name('cancel');
    //contact us route
    Route::get("contact-us", "IndexController@Contact")->name("contact");
    Route::post("contact/store", "IndexController@Contactstore")->name("contact.store");

    //blog route
    Route::get("blog", "IndexController@Blog")->name("blog");

});
    //social login
    Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class,"redirectToProvider",])->name("social.oauth");
    Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class,"handleProviderCallback",])->name("social.callback");