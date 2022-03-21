<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use Carbon\Carbon;
use DB;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //show all subcategory method
    public function index(){
        $data = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')->select('subcategories.*', 'categories.category_name')->get();
        $category = DB::table('categories')->get();
        return view('admin.category.subcategory.index', compact('data','category'));
    }

    //insert subcategory method
    public function store(Request $request){
        $validated = $request->validate([
        'subcat_name' => 'required|max:55',
    ]);
        $data = array();
        $data ['category_id'] = $request->category_id;
        $data ['subcat_name'] = $request->subcat_name;
        $data ['subcat_slug'] = Str::slug($request->subcat_name, '-');
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('subcategories')->insert($data);
        $notify = array('messege' => 'SubCategory Create Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //subcategory edit method
    public function edit($id){
        $category = DB::table('categories')->get();
        $data = DB::table('subcategories')->where('id',$id)->first();
        return view('admin.category.subcategory.edit', compact('category', 'data'));
    }

    //subcategory update method
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $data ['category_id'] = $request->category_id;
        $data ['subcat_name'] = $request->subcat_name;
        $data ['subcat_slug'] = Str::slug($request->subcat_name, '-');
        $data ['updated_at'] = Carbon::now();
        DB::table('subcategories')->where('id', $id)->update($data);
        $notify = array('messege' => 'SubCategory Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //subcategory destroy method
    public function destroy($id){
        DB::table('subcategories')->where('id',$id)->delete();
        $notify = array('messege' => 'SubCategory Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

}
