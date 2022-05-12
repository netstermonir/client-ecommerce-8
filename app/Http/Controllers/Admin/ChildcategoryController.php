<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use DataTables;
use Carbon\Carbon;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //child category show method
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')->select('categories.category_name','subcategories.subcat_name','childcategories.*')->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('childcategory.delete', [$row->id]).'" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        $category = DB::table('categories')->get();
        return view('admin.category.childcategory.index', compact('category'));
    }

    //childcategory store method
    public function store(Request $request){
        $validated = $request->validate([
        'childcategory_name' => 'required|max:55',
    ]);
        $id = $request->subcategory_id;
        $cat = DB::table('subcategories')->where('id', $id)->first();
        $data = array();
        $data ['category_id'] = $cat->category_id;
        $data ['subcategory_id'] = $request->subcategory_id;
        $data ['childcategory_name'] = $request->childcategory_name;
        $data ['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('childcategories')->insert($data);
        $notify = array('messege' => 'ChildCategory Create Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
    
    //childcategory edit method
    public function edit($id){
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();
        return view('admin.category.childcategory.edit', compact('category', 'data'));
    }

    //childcategory update method
    public function update(Request $request){
        $id = $request->subcategory_id;
        $cat = DB::table('subcategories')->where('id', $id)->first();
        $data = array();
        $data ['category_id'] = $cat->category_id;
        $data ['subcategory_id'] = $request->subcategory_id;
        $data ['childcategory_name'] = $request->childcategory_name;
        $data ['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        $data ['updated_at'] = Carbon::now();
        DB::table('childcategories')->where('id', $request->id)->update($data);
        $notify = array('messege' => 'ChildCategory Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //childcategory delete method
    public function destroy($id){
        DB::table('childcategories')->where('id', $id)->delete();
        $notify = array('messege' => 'ChildCategory Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
