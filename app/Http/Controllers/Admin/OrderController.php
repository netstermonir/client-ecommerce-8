<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //all orders show method
    public function AllOrders(Request $request)
    {
        // yajra DataTables
        if ($request->ajax()) {
            $product = "";
            $query = DB::table('orders')->orderBy('id', 'DESC');
                if ($request->payment_type) {
                    $query->where('payment_type', $request->payment_type);
                }
                if ($request->date) {
                    $order_date = date('d-m-Y', strtotime($request->date));
                    $query->where('date', $order_date);
                }
                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }

            $product = $query->get();
            return DataTables::of($product)->addIndexColumn()
            ->editColumn('status', function($row){
                if ($row->status == 0) {
                    return '<span class="badge badge-danger">Order Pending</span>';
                }
                elseif($row->status == 1) {
                    return '<span class="badge badge-primary">Order Received</span>';
                }
                elseif($row->status == 2) {
                    return '<span class="badge badge-warning">Order Shipped</span>';
                }
                elseif($row->status == 3) {
                    return '<span class="badge badge-success">Order Completed</span>';
                }
                elseif($row->status == 4) {
                    return '<span class="badge badge-warning">Order Return</span>';
                }
                elseif($row->status == 5) {
                    return '<span class="badge badge-danger">Order Cencel</span>';
                }
            })
            ->addColumn('action', function($row){
                $actionbtn = '
                    <a href="" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-info btn-sm show" data-toggle="modal" data-target="#ShowModal" data-id="'.$row->id.'" ><i class="fas fa-eye"></i></a>
                    <a href="'.route('order.delete', [$row->id]).'" id="order_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action', 'status'])->make(true);
        }
        return view('admin.order.index');
    }

    //order modal status
    public function edit($id)
    {
        $data = DB::table('orders')->where('id', $id)->first();
        return view('admin.order.edit', compact('data'));
    }

    //order view modal
    public function viewOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $id)->get();
        return view ('admin.order.order_details', compact('order', 'order_details'));
    }

    //order status update
    public function update(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data ['c_name'] = $request->c_name;
        $data ['c_address'] = $request->c_address;
        $data ['c_phone'] = $request->c_phone;
        $data ['c_email'] = $request->c_email;
        $data ['status'] = $request->status;
        $data ['updated_at'] = Carbon::now();
        DB::table('orders')->where('id', $id)->update($data);
        return response()->json('Order Status Update Sucessfull !');
    }

    //order details status update
    public function orderupdate(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data ['c_name'] = $request->c_name;
        $data ['c_address'] = $request->c_address;
        $data ['c_phone'] = $request->c_phone;
        $data ['c_email'] = $request->c_email;
        $data ['date'] = $request->date;
        $data ['c_country'] = $request->c_country;
        $data ['c_zipcode'] = $request->c_zipcode;
        $data ['c_city'] = $request->c_city;
        $data ['order_id'] = $request->order_id;
        $data ['payment_type'] = $request->payment_type;
        $data ['total'] = $request->total;
        $data ['status'] = $request->status;
        $data ['updated_at'] = Carbon::now();
        DB::table('orders')->where('id', $id)->update($data);
        return response()->json('Order Status Update Sucessfull !');
    }

    //order delete method ajax
    public function destroy($id)
    {
        $order = DB::table('orders')->where('id', $id)->delete();
        $order_details = DB::table('order_details')->where('order_id', $id)->delete();
        return response()->json('Order Delete Sucessfull !');
    }
}
