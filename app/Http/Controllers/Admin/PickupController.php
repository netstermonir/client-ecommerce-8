<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //pickup point show method
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('pickup_points')->latest()->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('pickuppoint.delete',[$row->id]).'" id="delete_pickup" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.pickup.index');
    }

    //pickup point store with ajax
    public function store(Request $request){
        $validated = $request->validate([
            'pickup_point_name' => 'required|unique:pickup_points',
        ]);
        $data = array();
        $data ['pickup_point_name'] = $request->pickup_point_name;
        $data ['pickup_point_address'] = $request->pickup_point_address;
        $data ['pickup_point_phone'] = $request->pickup_point_phone;
        $data ['created_at'] = Carbon::now();
        DB::table('pickup_points')->insert($data);
        return response()->json('Pickup Point Create Sucessfull');
    }

    //pickup point edit ajax
    public function edit($id){
        $data = DB::table('pickup_points')->where("id", $id)->first();
        return view('admin.pickup.edit', compact('data'));
    }

    //pickup point update with ajax
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $data ['pickup_point_name'] = $request->pickup_point_name;
        $data ['pickup_point_address'] = $request->pickup_point_address;
        $data ['pickup_point_phone'] = $request->pickup_point_phone;
        $data ['updated_at'] = Carbon::now();
        DB::table('pickup_points')->where('id', $id)->update($data);
        return response()->json('Pickup Point Update Sucessfull');
    }

    //pickup point delete with ajax
    public function destroy($id){
        DB::table('pickup_points')->where('id', $id)->delete();
        return response()->json('Pickup Point Delete Sucessfull');
    }
}
