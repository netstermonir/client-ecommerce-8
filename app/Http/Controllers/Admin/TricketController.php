<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Image;
use File;
use Carbon\Carbon;

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
                    return '<span class="badge badge-danger">Closed</span>';
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
                    <a href="'.route('tricket.view', [$row->id]).'" class="btn btn-info btn-sm show"><i class="fas fa-eye"></i></a>
                    <a href="'.route('tricket.delete', [$row->id]).'" id="tricket_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action', 'status', 'date'])->make(true);
        }
        return view('admin.tricket.index');
    }

    //admin tricket view
    public function View($id)
    {
        $tricket = DB::table('trickets')->leftJoin('users','trickets.user_id','users.id')->select('trickets.*','users.name')->where('trickets.id', $id)->first();
        return view('admin.tricket.view', compact('tricket'));
    }

    //admin tricket reply store
    public function TricketReply(Request $request)
    {
        $validated = $request->validate([
            "message" => "required",
        ]);
        $data = [];
        $data ['tricket_id'] = $request->tricket_id;
        $data ['user_id'] = 0;
        $data ['replied_message'] = $request->message;
        $data ['replied_date'] = date('m-d-Y');
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();
        $photo = $request->image;
        if ($photo) {
            //work with photo
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,450)->save('public/files/reply-tricket/' .$photoname);
            $data ['replied_image'] = 'public/files/reply-tricket/' .$photoname;
        }
        DB::table('trickets')->where('id', $request->tricket_id)->update(['status'=>1]);
        DB::table('replied')->insert($data);
        return response()->json(["success" => 'Tricket Reply Successfully !']);
    }

    //close tricket
    public function closeTricket($id)
    {
        DB::table('trickets')->where('id', $id)->update(['status'=>2]);
        $notify = ["messege" => "Tricket Closed Successfully !","alert-type" => "success",];
        return redirect()->route('tricket.index')->with($notify);
    }

    //tricket delete method
    public function destroy($id)
    {
        $tricket_data = DB::table('trickets')->where('id', $id)->first();
        $image = $tricket_data->image;
        if (File::exists($image)) {
            unlink($image);
            DB::table('trickets')->where('id', $id)->delete();
            return response()->json('Tricket Delete Successfully !');
        }
    }
}
