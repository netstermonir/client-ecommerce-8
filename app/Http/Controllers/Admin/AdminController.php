<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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

    //admin logout 
    public function logout(){
        Auth::logout();
        $notify = array('messege' => 'You are Logged Out', 'alert-type' => 'success');
        return redirect()->route("admin.login")->with($notify);
    }
}
