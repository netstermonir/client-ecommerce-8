<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //review store method
    public function store(Request $request){
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);
        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        if (!$check) {
            $data = array();
            $data ['user_id'] = Auth::id();
            $data ['product_id'] = $request->product_id;
            $data ['review'] = $request->review;
            $data ['rating'] = $request->rating;
            $data ['review_date'] = date('d-m-y');
            $data ['review_month'] = date('F');
            $data ['review_year'] = date('Y');
            $data ['created_at'] = Carbon::now();
            $data ['updated_at'] = Carbon::now();
            DB::table('reviews')->insert($data);
            $notify = array('messege' => 'Thanks For Your Review!', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        else{
            $notify = array('messege' => 'Already You Review Added This Product!', 'alert-type' => 'error');
            return redirect()->back()->with($notify);
        }
    }
}
