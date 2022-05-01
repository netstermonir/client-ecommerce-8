<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Review;

class IndexController extends Controller
{
    //index page load method
    public function index()
    {
        $category = DB::table("categories")->get();
        $brand = DB::table("brands")
            ->where("front_page", 1)
            ->orderBy("id", "DESC")
            ->get();
        $banner = Product::where("status", 1)
            ->where("product_slider", 1)
            ->latest()
            ->first();
        $featured = Product::where("status", 1)
            ->where("featured", 1)
            ->orderBy("id", "DESC")
            ->limit(16)
            ->get();
        $popular = Product::where("status", 1)
            ->where("product_views", 1)
            ->orderBy("id", "DESC")
            ->limit(16)
            ->get();
        $trendy = Product::where("status", 1)
            ->orderBy("id", "DESC")
            ->limit(16)
            ->get();
        $today_deal = Product::where("today_deal", 1)
            ->orderBy("id", "DESC")
            ->limit(6)
            ->get();
        //home page category wise
        $home_cat = DB::table("categories")
            ->where("status", 1)
            ->orderBy("id", "ASC")
            ->get();
        $random = Product::where("status", 1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        $review = DB::table("websitereviews")
            ->where("status", 1)
            ->orderBy("id", "DESC")
            ->limit(12)
            ->get();
        return view(
            "frontend.index",
            compact(
                "category",
                "brand",
                "banner",
                "featured",
                "popular",
                "trendy",
                "home_cat",
                "random",
                "today_deal",
                "review"
            )
        );
    }

    //product detials method
    public function productdetails($slug)
    {
        $productdetails = Product::where("slug", $slug)->first();
        Product::where("slug", $slug)->increment("product_views");
        // similar product
        $related_product = DB::table("products")
            ->where("subcategory_id", $productdetails->subcategory_id)
            ->orderBy("id", "DESC")
            ->take(10)
            ->get();
        //review
        $review = Review::where("product_id", $productdetails->id)
            ->orderBy("id", "DESC")
            ->take(10)
            ->get();
        return view(
            "frontend.product.product-details",
            compact("productdetails", "related_product", "review")
        );
    }

    //product quick view method
    public function productquickview($id)
    {
        $product = Product::where("id", $id)->first();
        return view("frontend.product.quick_view", compact("product"));
    }

    //category wise product show method
    public function CategoryWise($id)
    {
        $cat_name = DB::table("categories")
            ->where("id", $id)
            ->first();
        $subcat = DB::table("subcategories")
            ->where("category_id", $id)
            ->get();
        $brand = DB::table("brands")->get();
        $product = DB::table("products")
            ->where("category_id", $id)
            ->paginate(50);
        $random = Product::where("status", 1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        return view(
            "frontend.product.categorywise_product",
            compact("cat_name", "subcat", "brand", "product", "random")
        );
    }

    //sub category wise product show method
    public function SubCategoryWise($id)
    {
        $subcat_name = DB::table("subcategories")
            ->where("id", $id)
            ->first();
        $childcat = DB::table("childcategories")
            ->where("subcategory_id", $id)
            ->get();
        $brand = DB::table("brands")->get();
        $product = DB::table("products")
            ->where("subcategory_id", $id)
            ->paginate(50);
        $random = Product::where("status", 1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        return view(
            "frontend.product.subcategorywise_product",
            compact("subcat_name", "childcat", "brand", "product", "random")
        );
    }

    //child category wise product show method
    public function ChildCategoryWise($id)
    {
        $childcat_name = DB::table("childcategories")
            ->where("id", $id)
            ->first();
        $categories = DB::table("categories")
            ->where("id", $id)
            ->get();
        $brand = DB::table("brands")->get();
        $product = DB::table("products")
            ->where("childcategory_id", $id)
            ->paginate(50);
        $random = Product::where("status", 1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        return view(
            "frontend.product.childcategorywise_product",
            compact("childcat_name", "categories", "brand", "product", "random")
        );
    }

    //brand wise product show method
    public function BandCategoryWise($id)
    {
        $brand_name = DB::table("brands")
            ->where("id", $id)
            ->first();
        $categories = DB::table("categories")->get();
        $brand = DB::table("brands")->get();
        $product = DB::table("products")
            ->where("brand_id", $id)
            ->paginate(50);
        $random = Product::where("status", 1)
            ->inRandomOrder()
            ->limit(50)
            ->get();
        return view(
            "frontend.product.brandwise_product",
            compact("brand_name", "categories", "brand", "product", "random")
        );
    }

    //page view method
    public function viewPage($page_slug)
    {
        $page = DB::table("pages")
            ->where("page_slug", $page_slug)
            ->first();
        return view("frontend.page", compact("page"));
    }

    //newsletter store method
    public function Newsletter(Request $request)
    {
        $email = $request->email;
        $check = DB::table("newslatters")
            ->where("email", $email)
            ->first();
        if (!$check) {
            $data = [];
            $data["email"] = $request->email;
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();
            DB::table("newslatters")->insert($data);
            return response()->json(["success" => "Thanks for Subscribe !"]);
        } else {
            return response()->json(["error" => "Already Subscribed !"]);
        }
    }
}
