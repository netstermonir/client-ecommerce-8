<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;

class IndexController extends Controller
{
    //index page load method
    public function index(){
        $category = DB::table('categories')->get();
        $banner = Product::where('product_slider', 1)->latest()->first();
        return view("frontend.index", compact('category', 'banner'));
    }

    //product detials method
    public function productdetails($slug){
        $productdetails = Product::where('slug', $slug)->first();
        $related_product = DB::table('products')->where('subcategory_id', $productdetails->subcategory_id)->orderBy('id', 'DESC')->take(10)->get();
        return view("frontend.product-details", compact('productdetails', 'related_product'));
    }
}
