<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use DataTables;
use Carbon\Carbon;
use DB;
use Image;
use File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //brand show method
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('brands')->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('brand.delete', [$row->id]).'" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.category.brand.index');
    }

    //brand store method
    public function store(Request $request){
         $validated = $request->validate([
        'brand_name' => 'required|unique:brands|max:55',
        'brand_logo' => 'required',
    ]);
         $data = array();
         $slug = Str::slug($request->brand_name, '-');
         $data ['brand_name'] = $request->brand_name;
         $data ['brand_slug'] = Str::slug($request->brand_name, '-');
         //work with photo
         $photo = $request->brand_logo;
         $photoname = $slug.'.'.$photo->getClientOriginalExtension();
         // $photo->move('public/files/brand', $photoname); //without image intervention
         Image::make($photo)->resize(240,120)->save('public/files/brand/' .$photoname);
         $data ['brand_logo'] = 'public/files/brand/' .$photoname;
         $data ['created_at'] = Carbon::now();
         $data ['updated_at'] = Carbon::now();
         DB::table('brands')->insert($data);
         $notify = array('messege' => 'Brand Create Sucessfull !', 'alert-type' => 'success');
         return redirect()->back()->with($notify);
    }

    //brand edit method
    public function edit($id){
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('data'));
    }

    //brand update method
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $slug = Str::slug($request->brand_name, '-');
        $data ['brand_name'] = $request->brand_name;
        $data ['brand_slug'] = Str::slug($request->brand_name, '-');
        $data['front_page']=$request->front_page;
        if ($request->brand_logo) {
            if (File::exists($request->old_logo)) {
            unlink($request->old_logo);
        }
            $photo = $request->brand_logo;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            // $photo->move('public/files/brand', $photoname); //without image intervention
            Image::make($photo)->resize(240,120)->save('public/files/brand/'.$photoname);
            $data ['brand_logo'] = 'public/files/brand/'.$photoname;
            $data ['updated_at'] = Carbon::now();
            DB::table('brands')->where('id', $id)->update($data);
            $notify = array('messege' => 'Brand Update Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }else{
            $data ['brand_logo'] = $request->old_logo;
            $data ['updated_at'] = Carbon::now();
            DB::table('brands')->where('id', $id)->update($data);
            $notify = array('messege' => 'Brand Update Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
        
    }

    //brand delete method
    public function destroy($id){
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        if (File::exists($image)) {
            unlink($image);
            DB::table('brands')->where('id', $id)->delete();
            $notify = array('messege' => 'Brand Delete Sucessfull !', 'alert-type' => 'success');
            return redirect()->back()->with($notify);
        }
    }
}
