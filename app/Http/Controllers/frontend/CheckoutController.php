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
        if ($request->payment_type == 'Hand Cash') {
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
            $order["date"] = date('d-m-Y');
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
            $notify = ["messege" => "Order Place Successfully !","alert-type" => "success",];
            return redirect()->to("profile")->with($notify);
        }
        elseif ($request->payment_type == 'Aamarpay') {
            $aamarpay = DB::table('payment_getway_bd')->first();
            if ($aamarpay->store_id == NULL) {
                $notify = ["messege" => "Please Setup Payment Getway !","alert-type" => "error",];
                return redirect()->back()->with($notify);
            }else{
                if ($aamarpay->status == 1) {
                    $url = 'https://secure.aamarpay.com/request.php';
                }else{
                    $url = 'https://sandbox.aamarpay.com/request.php';
                }
                $fields = array(
                'store_id' => $aamarpay->store_id, //store id will be aamarpay
                'amount' => Cart::total(), //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => 'BDT',  //currenct will be USD/BDT
                'tran_id' => rand(1111111,9999999), //transaction id must be unique from your end
                'cus_name' => $request->c_name,  //customer name
                'cus_email' => $request->c_email, //customer email address
                'cus_add1' => $request->c_address,  //customer address
                'cus_add2' => 'Mohakhali DOHS', //customer address
                'cus_city' => $request->c_city,  //customer city
                'cus_state' => 'Dhaka',  //state
                'cus_postcode' => $request->c_zipcode, //postcode or zipcode
                'cus_country' => $request->c_country,  //country
                'cus_phone' => $request->c_phone, //customer phone number
                'cus_fax' => $request->c_extra_phone,  //fax
                'ship_name' => 'ship name', //ship name
                'ship_add1' => 'House B-121, Road 21',  //ship address
                'ship_add2' => 'Mohakhali',
                'ship_city' => 'Dhaka', 
                'ship_state' => 'Dhaka',
                'ship_postcode' => '1212', 
                'ship_country' => 'Bangladesh',
                'desc' => 'payment description', 
                'success_url' => route('success'), //your success route
                'fail_url' => route('fail'), //your fail route
                'cancel_url' => route('cancel'), //your cancel url
                'opt_a' => $request->c_country,  //country
                'opt_b' => $request->c_city, //city
                'opt_c' => $request->c_address, //customer address
                'opt_d' => $request->c_zipcode, //zipcode
                'signature_key' => $aamarpay->signature_key); //signature key will provided aamarpay

                $fields_string = http_build_query($fields);
         
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_URL, $url);  
          
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));  
                curl_close($ch); 

                $this->redirect_to_merchant($url_forward);
            }
        }
        else{
            echo 'paypal';
        }
    }
    //redirect to marcent 
    function redirect_to_merchant($url) 
    {
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php   
        exit;
    }
    //aamarpay success
    public function success(Request $request)
    {
        $order = [];
        $order["user_id"] = Auth::id();
        $order["c_name"] = $request->cus_name;
        $order["c_phone"] = $request->cus_phone;
        $order["c_country"] = $request->opt_a;
        $order["c_address"] = $request->opt_c;
        $order["c_email"] = $request->cus_email;
        $order["c_zipcode"] = $request->opt_d;
        $order["c_city"] = $request->opt_b;
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
        $order["payment_type"] = 'Aamarpay';
        $order["tax"] = 0;
        $order["shipping_charge"] = 0;
        $order["order_id"] = rand(1000, 9000000);
        $order["status"] = 1;
        $order["date"] = date('d-m-Y');
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
            Mail::to($request->cus_email)->send(
                new InvoiceMail($order, $details)
            );
        }
        Cart::destroy();
        if (Session::has("coupon")) {
            Session::forget("coupon");
        }
        $notify = ["messege" => "Order Place Successfully !","alert-type" => "success",];
        return redirect()->to("profile")->with($notify);
    }
    //aamarpay fail
    public function fail(Request $request)
    {
        return $request;
    }
}
