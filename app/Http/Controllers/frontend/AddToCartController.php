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
}
