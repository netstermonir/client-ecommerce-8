<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    // admin login after
    public function admin()
    {
        return view("admin.home");
    }
    //password Change
    public function passwordChange(){
        return view('admin.profile.password-change');
    }

    //admin password update
    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'old_pass' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $current_pass = Auth::user()->password;
        $oldpass = $request->old_pass;
        $newpass = $request->password;
        if (Hash::check($oldpass, $current_pass)) {
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($newpass);
            $user->save();
            Auth::logout();
        $notify = array('messege' => 'You are Successfully Change Password', 'alert-type' => 'success');
        return redirect()->route("admin.login")->with($notify);
        }
        else{
            $notify = array('messege' => 'Old Password Not Match !', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }

    //admin logout 
    public function logout(){
        Auth::logout();
        $notify = array('messege' => 'You are Logged Out', 'alert-type' => 'success');
        return redirect()->route("admin.login")->with($notify);
    }
}
