<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;

class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //cupon show yajradatatable
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('cupons')->latest()->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('coupon.delete',[$row->id]).'" id="delete_coupon" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.offer.cupon.index');
    }

    //cupon store with ajax
    public function store(Request $request){
        $validated = $request->validate([
            'coupon_code' => 'required|unique:cupons|max:55',
        ]);
        $data = array();
        $data ['coupon_code'] = $request->coupon_code;
        $data ['type'] = $request->type;
        $data ['status'] = $request->status;
        $data ['coupon_amount'] = $request->coupon_amount;
        $data ['valid_date'] = $request->valid_date;
        $data ['created_at'] = Carbon::now();
        DB::table('cupons')->insert($data);
        return response()->json('Cupon Create Sucessfull');
    }

    //cupon edit method
    public function edit($id){
        $data = DB::table('cupons')->where("id", $id)->first();
        return view('admin.offer.cupon.edit', compact('data'));
    }

    //cupon update with ajax
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $data ['coupon_code'] = $request->coupon_code;
        $data ['type'] = $request->type;
        $data ['status'] = $request->status;
        $data ['coupon_amount'] = $request->coupon_amount;
        $data ['valid_date'] = $request->valid_date;
        $data ['updated_at'] = Carbon::now();
        DB::table('cupons')->where('id', $id)->update($data);
        return response()->json('Cupon Update Sucessfull');
    }

    //cupon delete with ajax
    public function destroy($id){
        DB::table('cupons')->where('id', $id)->delete();
        return response()->json('Cupon Delete Sucessfull');
    }
}
