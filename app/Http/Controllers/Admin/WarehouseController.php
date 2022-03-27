<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //warehouse show method
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('warehouse')->latest()->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('warehouse.delete', [$row->id]).'" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.category.warehouse.index');
    }

    //warehouse store method
    public function store(Request $request){
        $validated = $request->validate([
        'warehouse_name' => 'required|unique:warehouse',
        ]);
        $data = array();
        $data ['warehouse_name'] = $request->warehouse_name;
        $data ['warehouse_slug'] = Str::slug($request->warehouse_name, '-');
        $data ['warehouse_address'] = $request->warehouse_address;
        $data ['warehouse_phone'] = $request->warehouse_phone;
        $data ['created_at'] = Carbon::now();
        DB::table('warehouse')->insert($data);
        $notify = array('messege' => 'Warehouse Create Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //warehouse edit method
    public function edit($id){
        $data = DB::table('warehouse')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('data'));
    }

    //warehouse update method
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $data ['warehouse_name'] = $request->warehouse_name;
        $data ['warehouse_slug'] = Str::slug($request->warehouse_name, '-');
        $data ['warehouse_address'] = $request->warehouse_address;
        $data ['warehouse_phone'] = $request->warehouse_phone;
        $data ['updated_at'] = Carbon::now();
        DB::table('warehouse')->where('id', $id)->update($data);
        $notify = array('messege' => 'Warehouse Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //warehouse delete method
    public function destroy($id){
        DB::table('warehouse')->where('id', $id)->delete();
        $notify = array('messege' => 'Warehouse Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
