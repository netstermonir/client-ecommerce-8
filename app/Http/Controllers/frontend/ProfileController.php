<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //website review controller method
    public function websiteReview()
    {
        return view("user.websiteReview");
    }

    //website review store method
    public function Review(Request $request)
    {
        $validated = $request->validate([
            "review" => "required",
        ]);
        $check = DB::table("websitereviews")
            ->where("user_id", Auth::id())
            ->first();
        if (!$check) {
            $data = [];
            $data["user_id"] = Auth::id();
            $data["name"] = $request->name;
            $data["review"] = $request->review;
            $data["rating"] = $request->rating;
            $data["review_date"] = date("d, F Y");
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();
            $data["status"] = 0;
            DB::table("websitereviews")->insert($data);
            $notify = [
                "messege" => "Thanks For Your Review!",
                "alert-type" => "success",
            ];
            return redirect()
                ->back()
                ->with($notify);
        } else {
            $notify = [
                "messege" => "Already You Review Added!",
                "alert-type" => "error",
            ];
            return redirect()
                ->back()
                ->with($notify);
        }
    }

    //customer setting method
    public function CustomerSetting()
    {
        return view("user.setting");
    }
    //customer password change method
    public function passwordChange(Request $request)
    {
        $validated = $request->validate([
            "old_password" => "required",
            "password" => "required|min:8|confirmed",
        ]);
        $current_pass = Auth::user()->password;
        $oldpass = $request->old_pass;
        $newpass = $request->password;
        if (Hash::check($oldpass, $current_pass)) {
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($newpass);
            $user->save();
            Auth::logout();
            $notify = [
                "messege" => "You are Successfully Change Password",
                "alert-type" => "success",
            ];
            return redirect()
                ->back()
                ->with($notify);
        } else {
            $notify = [
                "messege" => "Old Password Not Match !",
                "alert-type" => "error",
            ];
            return redirect()
                ->back()
                ->with($notify);
        }
    }
    //myorder show method
    public function myOrder()
    {
        $orders = DB::table("orders")
            ->where("user_id", Auth::id())
            ->orderBy("id", "DESC")
            ->get();
        return view("user.myOrder", compact("orders"));
    }

    //support tircket show method
    public function tricket()
    {
        $tricket = DB::table('trickets')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        return view('user.tricket', compact('tricket'));
    }

    // all tricket show 
    public function Writetricket()
    {
        return view('user.writetricket');
    }

    //tricket store method
    public function submitTricket(Request $request)
    {
        $validated = $request->validate([
            "subject" => "required",
            "message" => "required",
        ]);
        $data = [];
        $data ['user_id'] = Auth::id();
        $data ['subject'] = $request->subject;
        $data ['service'] = $request->service;
        $data ['priority'] = $request->priority;
        $data ['message'] = $request->message;
        $photo = $request->image;
        if ($photo) {
            //work with photo
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,450)->save('public/files/tricket/' .$photoname);
            $data ['image'] = 'public/files/tricket/' .$photoname;
        }
        $data ['status'] = 0;
        $data ['date'] = date('Y-m-d');
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('trickets')->insert($data);
        return response()->json(["success" => 'Tricket Submit Successfully !']);
    }

    //tricket details view method
    public function Showtricket($id)
    {
        $tricket = DB::table('trickets')->where('id', $id)->first();
        return view('user.show', compact('tricket'));
    }

    //user tricket reply
    public function Replytricket(Request $request)
    {
        $validated = $request->validate([
            "message" => "required",
        ]);
        $data = [];
        $data ['tricket_id'] = $request->tricket_id;
        $data ['user_id'] = Auth::id();
        $data ['replied_message'] = $request->message;
        $data ['replied_date'] = date('m-d-Y');
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();
        $photo = $request->image;
        if ($photo) {
            //work with photo
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,450)->save('public/files/reply-tricket/' .$photoname);
            $data ['replied_image'] = 'public/files/reply-tricket/' .$photoname;
        }
        DB::table('trickets')->where('id', $request->tricket_id)->update(['status'=>0]);
        DB::table('replied')->insert($data);
        return response()->json(["success" => 'Tricket Reply Successfully !']);
    }

    //order details 
    public function ViewOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $id)->get();
        return view('user.view', compact('order_details', 'order'));
    }
}
