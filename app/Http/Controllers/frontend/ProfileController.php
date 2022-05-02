<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use DB;
use Carbon\Carbon;

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
}
