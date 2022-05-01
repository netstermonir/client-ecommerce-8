<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Cart;

class CheckoutController extends Controller
{
    // checkout page secure
    public function checkout()
    {
        if (Auth::check()) {
            return view("frontend.cart-page.checkout");
        } else {
            $notify = [
                "messege" => "Login Your Account First !",
                "alert-type" => "error",
            ];
            return redirect()
                ->back()
                ->with($notify);
        }
    }

    //apply coupon code ajax
    public function Coupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = DB::table("cupons")
            ->where("coupon_code", $coupon)
            ->first();
        if (!$check) {
            return response()->json("Invalide Coupon Code");
        } else {
            if (
                date("Y-m-d", strtotime(date("Y-m-d"))) <=
                date("Y-m-d", strtotime($check->valid_date))
            ) {
                Session::put("coupon", [
                    "name" => $check->coupon_code,
                    "discount" => $check->coupon_amount,
                    // "after_discount" =>
                    //     Cart::subtotal() * $check->coupon_amount,
                ]);
                return response()->json([
                    "success" => "Coupon Apply Successfull !",
                ]);
            } else {
                return response()->json([
                    "error" => "Coupon Expired !",
                ]);
            }
        }
    }
}
