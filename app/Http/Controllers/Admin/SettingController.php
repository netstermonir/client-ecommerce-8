<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    // seo page show method 
    public function seo(){
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }

    //seoUpdate method
    public function seoUpdate(Request $request, $id){
        $data = array();
        $data ['meta_author'] = $request->meta_author;
        $data ['meta_tag'] = $request->meta_tag;
        $data ['meta_title'] = $request->meta_title;
        $data ['meta_description'] = $request->meta_description;
        $data ['meta_keyword'] = $request->meta_keyword;
        $data ['google_verification'] = $request->google_verification;
        $data ['google_analytics'] = $request->google_analytics;
        $data ['alexa_verification'] = $request->alexa_verification;
        $data ['google_adsence'] = $request->google_adsence;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('seos')->where('id', $id)->update($data);
        $notify = array('messege' => 'Seo Setting Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //smtp setting view method
    public function smtp(){
        $data = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('data'));
    }

    //smtp setting update method
    public function smtpUpdate(Request $request, $id){
        $data = array();
        $data ['mailer'] = $request->mailer;
        $data ['host'] = $request->host;
        $data ['port'] = $request->port;
        $data ['user_name'] = $request->user_name;
        $data ['password'] = $request->password;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('smtp')->where('id', $id)->update($data);
        $notify = array('messege' => 'Smtp Setting Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
