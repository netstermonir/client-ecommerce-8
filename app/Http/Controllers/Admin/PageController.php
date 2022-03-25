<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PageController extends Controller
{
   public function __construct()
    {
        $this->middleware("auth");
    }

    //page show method
    public function index(){
        $data = DB::table('pages')->latest()->get();
        return view('admin.setting.pages.index', compact('data'));
    }

    //page create method
    public function create(){
        return view('admin.setting.pages.create');
    }

    //page store method
    public function store(Request $request){
        $validated = $request->validate([
            'page_position' => 'required',
            'page_name' => 'required',
            'page_title' => 'required',
            'page_description' => 'required',
        ]);
        $data = array();
        $data ['page_position'] = $request->page_position;
        $data ['page_name'] = $request->page_name;
        $data ['page_slug'] = Str::slug($request->page_name, '-');
        $data ['page_title'] = $request->page_title;
        $data ['page_description'] = $request->page_description;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('pages')->insert($data);
        $notify = array('messege' => 'Page Create Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //page delete method
    public function destroy($id){
        DB::table('pages')->where('id', $id)->delete();
        $notify = array('messege' => 'Page Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //page edit method
    public function edit($id){
        $data = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.pages.edit', compact('data'));
    }

    //page update method
    public function pageUpdate(Request $request, $id){
        $data = array();
        $data ['page_position'] = $request->page_position;
        $data ['page_name'] = $request->page_name;
        $data ['page_slug'] = Str::slug($request->page_name, '-');
        $data ['page_title'] = $request->page_title;
        $data ['page_description'] = $request->page_description;
        $data ['updated_at'] = Carbon::now();
        DB::table('pages')->where('id', $id)->update($data);
        $notify = array('messege' => 'Page Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->route('page.index')->with($notify);
    }
}
