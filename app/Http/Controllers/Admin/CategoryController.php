<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    //all category showing method
    public function index(){
        $data = DB::table('categories')->get();//query builder
        // $data = Category::all();//eluquent orm
        return view('admin.category.category.index', compact('data'));
    }

    //category store method 
    public function store(Request $request){
        $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:55',
    ]);

        //query builder
        $data = array();
        $slug = Str::slug($request->category_name, '-');
        $data ['category_name']=$request->category_name;
        $data ['category_slug']=Str::slug($request->category_name, '-');
        $data ['status']=$request->status;
         //work with photo
         $photo = $request->icon;
         $photoname = $slug.'.'.$photo->getClientOriginalExtension();
         Image::make($photo)->resize(32,32)->save('public/files/icons/' .$photoname);
         $data ['icon'] = 'public/files/icons/' .$photoname;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('categories')->insert($data);
        $notify = array('messege' => 'Category Create Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //category edit method 
    public function edit($id){
        $data = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.category.edit', compact('data'));
    }

    //category update method 
    public function update(Request $request){
        //query builder
        $id = $request->id;
        $data = array();
        $slug = Str::slug($request->category_name, '-');
        $data ['category_name']=$request->category_name;
        $data ['category_slug']=Str::slug($request->category_name, '-');
        $data ['status']=$request->status;
        if ($request->icon) {
            if (File::exists($request->old_logo)) {
            unlink($request->old_logo);
        }
            $photo = $request->icon;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            // $photo->move('public/files/brand', $photoname); //without image intervention
            Image::make($photo)->resize(32,32)->save('public/files/icons/'.$photoname);
            $data ['icon'] = 'public/files/icons/'.$photoname;
            $data ['updated_at'] = Carbon::now();
            DB::table('categories')->where('id', $id)->update($data);
            $notify = array('messege' => 'Category Update Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }else{
            $data ['icon'] = $request->old_logo;
            $data ['updated_at'] = Carbon::now();
            DB::table('categories')->where('id', $id)->update($data);
            $notify = array('messege' => 'Category Update Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }  
    }

    //category delete method 
    public function destroy($id){
        $data = DB::table('categories')->where('id', $id)->first();
        $icon = $data->icon;
        if (File::exists($icon)) {
            unlink($icon);
            DB::table('categories')->where('id', $id)->delete();
            $notify = array('messege' => 'Category Delete Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
    }

    //get child cat method
    public function getChildcat($id){
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }
}
