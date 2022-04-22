<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\Review;

class IndexController extends Controller
{
    //index page load method
    public function index(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->where('front_page', 1)->orderBy('id', 'DESC')->get();
        $banner = Product::where('status', 1)->where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $popular = Product::where('status', 1)->where('product_views', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $trendy = Product::where('status', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $today_deal = Product::where('today_deal', 1)->orderBy('id', 'DESC')->limit(6)->get();
        //home page category wise
        $home_cat = DB::table('categories')->where('status', 1)->orderBy('id', 'ASC')->get();
        $random = Product::where('status', 1)->inRandomOrder()->limit(50)->get();
        return view("frontend.index", compact('category', 'brand', 'banner', 'featured', 'popular', 'trendy', 'home_cat', 'random', 'today_deal'));
    }

    //product detials method
    public function productdetails($slug){
        $productdetails = Product::where('slug', $slug)->first();
        Product::where('slug', $slug)->increment('product_views');
        // similar product 
        $related_product = DB::table('products')->where('subcategory_id', $productdetails->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();
        //review
        $review = Review::where('product_id', $productdetails->id)->orderBy('id', 'DESC')->take(10)->get();
        return view("frontend.product.product-details", compact('productdetails', 'related_product', 'review'));
    }

    //product quick view method
    public function productquickview($id){
        $product = Product::where('id', $id)->first();
        return view('frontend.product.quick_view', compact('product'));
    }
}
