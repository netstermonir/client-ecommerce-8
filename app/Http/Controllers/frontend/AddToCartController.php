<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use DB;
use Auth;
use Carbon\Carbon;

class AddToCartController extends Controller
{
    //quick view add to cart with ajax method
    public function AddToCart(Request $request){
        $id = $request->id;
        $product = DB::table('products')->where('id', $id)->first();
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->thumbnail
            ]
        ]);
        return response()->json('Product AddToCart SuccessFull !');
    }

    //cart total realtime
    public function AllCart(){
        $data = array();
        $data ['cart_qty'] = Cart::count();
        $data ['cart_total'] = Cart::total();
        return response()->json($data);
    }

     //product wishlist method
    public function addwishlist($id){
        if (Auth::check()) {
            $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();
            if (!$check) {
                $data = array();
                $data ['product_id'] = $id;
                $data ['user_id'] = Auth::id();
                $data ['date'] = date('d, F Y');
                $data ['created_at'] = Carbon::now();
                $data ['updated_at'] = Carbon::now();
                DB::table('wishlists')->insert($data);
                $notify = array('messege' => 'Product Added On Wishlists!', 'alert-type' => 'success');
                return redirect()->back()->with($notify);
            }
            else{
                $notify = array('messege' => 'Already Product Added On Wishlists!', 'alert-type' => 'error');
                return redirect()->back()->with($notify);
            }
        }
        else{
            $notify = array('messege' => 'Please Login Your Account !', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    //whislist page 
    public function whitelistPage(){
        if (Auth::check()) {
            $wishlist = DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
            return view('frontend.cart-page.whishlist', compact('wishlist'));
        }
        else{
            $notify = array('messege' => 'Please Login Your Account !', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    //whishlist clear method
    public function whitelistEmpty(){
        DB::table('wishlists')->where('user_id',Auth::id())->delete();
        $notification=array('messege' => 'Wishlist Clear SuccessFull !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //whislist product remove
    public function whitelistdelete($id){
        DB::table('wishlists')->where('id',$id)->delete();
        $notification=array('messege' => 'WhishList Product Successfully Deleted !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //cart page content method
    public function MyCart(){
        $cart_data = Cart::content();
        return view('frontend.cart-page.cart', compact('cart_data'));
    }

    //cart page product remove
    public function RemoveProduct($rowId){
        Cart::remove($rowId);
        return response()->json('Product Remove SuccessFull !');
    }

    //cart product qty update
    public function CarProductqty($qty, $rowId){
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('Product Qty Update SuccessFull !');
    }

    //cart product size update
    public function CarProductsize($size, $rowId){
        $product = Cart::get($rowId);
        $color = $product->options->color;
        $thumbnail = $product->options->thumbnail;
        Cart::update($rowId, ['options'  => ['size' => $size,  'color' => $color, 'thumbnail' => $thumbnail]]);
        return response()->json('Product Color Update SuccessFull !');
    }

    //cart product color update
    public function CarProductcolor($color, $rowId){
        $product = Cart::get($rowId);
        $size = $product->options->size;
        $thumbnail = $product->options->thumbnail;
        Cart::update($rowId, ['options'  => ['color' => $color,  'size' => $size, 'thumbnail' => $thumbnail]]);
        return response()->json('Product Color Update SuccessFull !');
    }

    //cart clear method
    public function CartEmpty(){
        Cart::destroy();
        $notify = array('messege' => 'Cart Items Clear SuccessFull !', 'alert-type' => 'success');
        return redirect()->to('/')->with($notify);
    }
}
