<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File; 
use Image;
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

    //website setting show method
    public function website(){
        $data = DB::table('settings')->first();
        return view('admin.setting.website-setting', compact('data'));
    }

    //website setting update method
    public function websiteUpdate(Request $request, $id){
        $data = array();
        $data ['currency'] = $request->currency;
        $data ['phone_one'] = $request->phone_one;
        $data ['phone_two'] = $request->phone_two;
        $data ['main_mail'] = $request->main_mail;
        $data ['support_mail'] = $request->support_mail;
        $data ['facebook'] = $request->facebook;
        $data ['linkedin'] = $request->linkedin;
        $data ['pinterest'] = $request->pinterest;
        $data ['messenger'] = $request->messenger;
        $data ['instagram'] = $request->instagram;
        $data ['whatsapp'] = $request->whatsapp;
        $data ['youtube'] = $request->youtube;
        $data ['address'] = $request->address;
        if ($request->logo) {
                if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
                }
            $logo = $request->logo;
            $logo_name = uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320,120)->save('public/files/setting/' .$logo_name);
            $data ['logo'] = 'public/files/setting/' .$logo_name;
        }
        else{
            $data ['logo'] = $request->old_logo;
        }
        if ($request->favicon) {
                if (File::exists($request->old_favicon)) {
                unlink($request->old_favicon);
                }
            $favicon = $request->favicon;
            $favicon_name = uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32,32)->save('public/files/setting/' .$favicon_name);
            $data ['favicon'] = 'public/files/setting/' .$favicon_name;
        }
        else{
            $data ['favicon'] = $request->old_favicon;
        }
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('settings')->where('id', $id)->update($data);
        $notify = array('messege' => 'website Setting Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //payment getway setting
    public function Paymentgetway()
    {
        $aamarpay = DB::table('payment_getway_bd')->first();
        $surjopay = DB::table('payment_getway_bd')->skip(1)->first();
        $sslpay = DB::table('payment_getway_bd')->skip(2)->first();
        return view('admin.payment-bd.edit', compact('aamarpay', 'surjopay', 'sslpay'));
    }

    //update aamarpay
    public function AamarpayUpdate(Request $request, $id)
    {
        $data = [];
        $data ['store_id'] = $request->store_id;
        $data ['signature_key'] = $request->signature_key;
        $data ['status'] = $request->status;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('payment_getway_bd')->where('id', $id)->update($data);
        $notify = array('messege' => 'AamarPay Setting Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
