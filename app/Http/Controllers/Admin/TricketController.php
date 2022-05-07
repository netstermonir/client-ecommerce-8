<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Image;

class TricketController extends Controller
{
     public function __construct()
    {
        $this->middleware("auth");
    }

    //tricket page load admin panel
    public function index(Request $request)
    {
        // yajra DataTables
        if ($request->ajax()) {
            $tricket = "";
            $query = DB::table('trickets')->leftJoin('users','trickets.user_id','users.id');
                if ($request->date) {
                    $query->where('trickets.date',$request->date);
                }
                if ($request->type=='Technical') {
                    $query->where('trickets.service',$request->type);
                }
                if ($request->type=='Payment') {
                    $query->where('trickets.service',$request->type);
                }
                if ($request->type=='Order') {
                    $query->where('trickets.service',$request->type);
                }
                if ($request->type=='Return') {
                    $query->where('trickets.service',$request->type);
                }
                if ($request->type=='Affiliate') {
                    $query->where('trickets.service',$request->type);
                }
                if ($request->status==1) {
                    $query->where('trickets.status',1);
                }
                if ($request->status==2) {
                    $query->where('trickets.status',2);
                }
                if ($request->status==0) {
                    $query->where('trickets.status',0);
                }

            $tricket = $query->select('trickets.*','users.name')->get();
            return DataTables::of($tricket)->addIndexColumn()
            ->editColumn('status', function($row){
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Running</span>';
                }
                elseif ($row->status == 2) {
                    return '<span class="badge badge-muted">Closed</span>';
                }
                else{
                    return '<span class="badge badge-warning">Pending</span>';
                }
            })
            ->editColumn('date', function($row){
               return date('m-d-Y', strtotime($row->date));
            })
            ->addColumn('action', function($row){
                $actionbtn = '
                    <a href="#" class="btn btn-info btn-sm show"><i class="fas fa-eye"></i></a>
                    <a href="'.route('product.delete', [$row->id]).'" id="product_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action', 'status', 'date'])->make(true);
        }
        return view('admin.tricket.index');
    }
}
