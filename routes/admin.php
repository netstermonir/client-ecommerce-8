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

    //global route
    Route::get('get-child-category/{id}', "CategoryController@getChildcat");

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

    //product Route
    Route::group(['prefix' => 'product'], function() {
        Route::get("/", "ProductController@index")->name("product.index");
        Route::get("/create", "ProductController@create")->name("product.create");
        Route::post("/store", "ProductController@store")->name("product.store");
        Route::delete('/delete/{id}','ProductController@destroy')->name('product.delete');
        Route::get("/edit/{id}", "ProductController@edit")->name("product.edit");
        Route::post("/update", "ProductController@update")->name("product.update");
        Route::get("/not-featured/{id}", "ProductController@notfeatured");
        Route::get("/featured/{id}", "ProductController@featured");
        Route::get("/not-deal/{id}", "ProductController@notdeal");
        Route::get("/deal/{id}", "ProductController@deal");
        Route::get("/not-status/{id}", "ProductController@notstatus");
        Route::get("/status/{id}", "ProductController@status");
    });

    //order Route
    Route::group(['prefix' => 'order'], function() {
        Route::get("all/orders", "OrderController@AllOrders")->name("admin.orders.index");
        Route::get("/view/{id}", "OrderController@viewOrder");
        Route::delete('/delete/{id}','OrderController@destroy')->name('order.delete');
        Route::get("/edit/{id}", "OrderController@edit");
        Route::post("order/update", "OrderController@update")->name("order.status.update");
        Route::post("order/status/update", "OrderController@orderupdate")->name("order.details.status.update");
    });

    //cupon Route
    Route::group(['prefix' => 'cupon'], function() {
        Route::get("/", "CuponController@index")->name("cupon.index");
        Route::post("/store", "CuponController@store")->name("cupon.store");
        Route::delete('/delete/{id}','CuponController@destroy')->name('coupon.delete');
        Route::get("/edit/{id}", "CuponController@edit");
        Route::post("/update", "CuponController@update")->name("cupon.update");
    });

    //Campaign Route
    Route::group(['prefix' => 'campaign'], function() {
        Route::get("/", "CampaignController@index")->name("campaign.index");
        Route::post("/store", "CampaignController@store")->name("campaign.store");
        Route::delete('/delete/{id}','CampaignController@destroy')->name('campaign.delete');
        Route::get("/edit/{id}", "CampaignController@edit");
        Route::post("/update", "CampaignController@update")->name("campaign.update");
        //campaign product
        Route::get("/product/{campaign_id}", "CampaignController@campaignProduct")->name("campaign.product");
        Route::get("/product/store/{id}/{campaign_id}", "CampaignController@campaignProductstore")->name("campaign.product.store");
        Route::get("/product/list/{campaign_id}", "CampaignController@campaignProductList")->name("campaign.product.list");
        Route::get("/product/delete/{id}", "CampaignController@campaignProductdelete")->name("campaign.product.delete");
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
        // smtp setting
        Route::group(['prefix' => 'payment-getway'], function() {
            Route::get("/", "SettingController@Paymentgetway")->name("payment.getway");
            Route::post("aamarpay/update/{id}", "SettingController@AamarpayUpdate")->name("aamarpay.update");
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
        //tricket Route
        Route::group(['prefix' => 'tricket'], function() {
            Route::get("/", "TricketController@index")->name("tricket.index");
            Route::get("tricket/view/{id}", "TricketController@View")->name("tricket.view");
            Route::post("tricket/reply", "TricketController@TricketReply")->name("admin.store.reply");
            Route::get("close/tricket/{id}", "TricketController@closeTricket")->name("admin.close.tricket");
            Route::delete("tricket/delete/{id}", "TricketController@destroy")->name("tricket.delete");
        });
        //blog category Route
        Route::group(['prefix' => 'blog'], function() {
            Route::get("/", "BlogController@index")->name("blog.category.index");
            Route::post("/store", "BlogController@store")->name("blog.category.store");
            Route::delete('/delete/{id}','BlogController@destroy')->name('blog.category.delete');
            Route::get("/edit/{id}", "BlogController@edit");
            Route::post("/update", "BlogController@update")->name("blog_category.update");
        });
    });
        //order report print 
        Route::group(['prefix' => 'report'], function() {
            Route::get("/", "OrderController@Reportindex")->name("order.report.index");
            Route::get("/print", "OrderController@ReportPrint")->name("report.order.print");
        });
        //user role
        Route::group(['prefix' => 'role'], function() {
            Route::get("/user", "RoleController@roleCreate")->name("userRole.create");
            Route::post("/store", "RoleController@rolestore")->name("role.store");
            Route::get("/all/role", "RoleController@Allrole")->name("manage.role");
            Route::get("/role/delete/{id}", "RoleController@destroy")->name("role.delete");
            Route::get("/role/edit/{id}", "RoleController@edit")->name("role.edit");
            Route::post("/role/update", "RoleController@update")->name("role.update");
        });
});