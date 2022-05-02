<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Cart;
use Carbon\Carbon;
use Mail;
use App\Mail\InvoiceMail;

class CheckoutController extends Controller
{
    // checkout page secure
    public function checkout()
    {
        if (Auth::check()) {
            $content = Cart::content();
            return view("frontend.cart-page.checkout", compact("content"));
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
        $check = DB::table("cupons")
            ->where("coupon_code", $request->coupon)
            ->first();
        if ($check) {
            if (
                date("Y-m-d", strtotime(date("Y-m-d"))) <=
                date("Y-m-d", strtotime($check->valid_date))
            ) {
                Session::put("coupon", [
                    "name" => $check->coupon_code,
                    "discount" => $check->coupon_amount,
                    "after_discount" =>
                        Cart::subtotal() - $check->coupon_amount,
                ]);
                return response()->json([
                    "success" => "Coupon Apply Successfull !",
                ]);
            } else {
                return response()->json([
                    "error" => "Coupon Expired !",
                ]);
            }
        } else {
            return response()->json(["errormessage" => "Invalide Coupon Code"]);
        }
    }

    //coupon remove
    public function Couponremove()
    {
        session::forget("coupon");
        $notify = ["messege" => "Coupon Removed !", "alert-type" => "success"];
        return redirect()
            ->back()
            ->with($notify);
    }

    //order place
    public function orderPlcae(Request $request)
    {
        $validated = $request->validate([
            "c_name" => "required",
            "c_phone" => "required",
            "c_country" => "required",
            "c_address" => "required",
            "c_email" => "required",
            "c_zipcode" => "required",
            "c_city" => "required",
            "payment_type" => "required",
        ]);
        $order = [];
        $order["user_id"] = Auth::id();
        $order["c_name"] = $request->c_name;
        $order["c_phone"] = $request->c_phone;
        $order["c_country"] = $request->c_country;
        $order["c_address"] = $request->c_address;
        $order["c_email"] = $request->c_email;
        $order["c_zipcode"] = $request->c_zipcode;
        $order["c_city"] = $request->c_city;
        $order["c_extra_phone"] = $request->c_extra_phone;
        if (Session::has("coupon")) {
            $order["subtotal"] = Cart::subtotal();
            $order["total"] = Cart::total();
            $order["coupon_code"] = Session::get("coupon")["name"];
            $order["coupon_discount"] = Session::get("coupon")["discount"];
            $order["after_discount"] = Session::get("coupon")["after_discount"];
        } else {
            $order["subtotal"] = Cart::subtotal();
            $order["total"] = Cart::total();
        }
        $order["payment_type"] = $request->payment_type;
        $order["tax"] = 0;
        $order["shipping_charge"] = 0;
        $order["order_id"] = rand(1000, 9000000);
        $order["status"] = 0;
        $order["date"] = date("d-m-Y");
        $order["month"] = date("F");
        $order["year"] = date("Y");
        $order["created_at"] = Carbon::now();
        $order["updated_at"] = Carbon::now();
        $order_id = DB::table("orders")->insertGetId($order);
        //order details table
        $content = Cart::content();
        $details = [];
        foreach ($content as $row) {
            $details["order_id"] = $order_id;
            $details["product_id"] = $row->id;
            $details["product_name"] = $row->name;
            $details["product_image"] = $row->options->thumbnail;
            $details["color"] = $row->options->color;
            $details["size"] = $row->options->size;
            $details["quantity"] = $row->qty;
            $details["product_price"] = $row->price;
            $details["subtotal_price"] = $row->price * $row->qty;
            $details["created_at"] = Carbon::now();
            $details["updated_at"] = Carbon::now();
            DB::table("order_details")->insert($details);
            // send mail
            Mail::to($request->c_email)->send(
                new InvoiceMail($order, $details)
            );
        }
        Cart::destroy();
        if (Session::has("coupon")) {
            Session::forget("coupon");
        }
        // return response()->json(["success"=> "Order Place SuccessFull !"]);
        $notify = [
            "messege" => "Order Place Successfully !",
            "alert-type" => "success",
        ];
        return redirect()
            ->to("profile")
            ->with($notify);
    }
    public function index()
    {
        return view("frontend.mail.invoice");
    }
}
