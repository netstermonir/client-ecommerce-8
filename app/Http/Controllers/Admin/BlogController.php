<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use DataTables;

class BlogController extends Controller
{
    //blog category show 
    public function index(Request $request)
    {
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('blog_categoy')->latest()->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('blog.category.delete',[$row->id]).'" id="delete_blog_category" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.blog.index');
    }

    //blog category store method
    public function store(Request $request)
    {
        $validated = $request->validate([
            'blog_categoy_name' => 'required|unique:blog_categoy|max:55',
        ]);
        $data = [];
        $data ['blog_categoy_name'] = $request->blog_categoy_name;
        $data ['slug']=Str::slug($request->blog_categoy_name, '-');
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('blog_categoy')->insert($data);
        return response()->json('Category Create Sucessfull !!');
    }

    //edit view modal
    public function edit($id)
    {
        $data = DB::table('blog_categoy')->where('id', $id)->first();
        return view('admin.blog.edit', compact('data'));
    }

    //blog category update
    public function update(Request $request)
    {
        $data = [];
        $data ['blog_categoy_name'] = $request->blog_categoy_name;
        $data ['slug']=Str::slug($request->blog_categoy_name, '-');
        $data ['updated_at'] = Carbon::now();
        DB::table('blog_categoy')->where('id', $request->id)->update($data);
        return response()->json('Category Update Sucessfull !!');
    }

    //blog category delete
    public function destroy($id)
    {
        DB::table('blog_categoy')->where('id', $id)->delete();
        return response()->json('Category Delete Sucessfull !!');
    }
}
