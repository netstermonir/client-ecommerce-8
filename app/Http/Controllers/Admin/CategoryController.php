<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    //all category showing
    public function index(){
        //$data = DB::table('categories')->get();//query builder
        $data = Category::all();//eluquent orm
        return view('admin.category.category.index', compact('data'));
    }

    //store all category
    public function store(Request $request){
        $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:55',
    ]);

        //query builder
        $data = array();
        $data ['category_name']=$request->category_name;
        $data ['category_slug']=Str::slug($request->category_name, '-');
        DB::table('categories')->insert($data);
        $notify = array('messege' => 'Category Add Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    // edit method 
    public function edit($id){
        $data = DB::table('categories')->where('id',$id)->first();
        return response()->json($data);
    }

    // update method 
    public function update(Request $request){
        //query builder
        $id = $request->id;
        $data = array();
        $data ['category_name']=$request->category_name;
        $data ['category_slug']=Str::slug($request->category_name, '-');
        DB::table('categories')->where('id', $id)->update($data);
        $notify = array('messege' => 'Category Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //delete category 
    public function destroy($id){
        DB::table('categories')->where('id', $id)->delete();
        $notify = array('messege' => 'Category Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
