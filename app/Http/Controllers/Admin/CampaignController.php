<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Carbon\Carbon;
use DB;
use Image;
use File;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //all campaign show method
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $data = DB::table('campaigns')->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="'.$row->id.'" ><i class="fas fa-edit"></i></a>
                    <a href="'.route('campaign.delete', [$row->id]).'" id="campaign_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->editColumn('status', function($row){
                if ($row->status == 1) {
                    return '<i class="fas fa-thumbs-up text-success"></i>  <span class="badge badge-success">Active</span>';
                }
                else{
                    return '<i class="fas fa-thumbs-down text-danger"></i>  <span class="badge badge-danger">Inactive</span>';
                }
            })->rawColumns(['action', 'status'])->make(true);
        }
        return view('admin.offer.campaign.index');
    }

    //campaign data store method
    public function store(Request $request){
        $validated = $request->validate([
        'name' => 'required|unique:campaigns|max:55',
        ]);
        $data = array();
         $slug = Str::slug($request->name, '-');
         $data ['name'] = $request->name;
         $data ['slug'] = Str::slug($request->name, '-');
         $data ['start_date'] = $request->start_date;
         $data ['end_date'] = $request->end_date;
         $data ['status'] = $request->status;
         $data ['discount'] = $request->discount;
         //work with photo
         $photo = $request->image;
         $photoname = $slug.'.'.$photo->getClientOriginalExtension();
         // $photo->move('public/files/brand', $photoname); //without image intervention
         Image::make($photo)->resize(240,120)->save('public/files/campaign/' .$photoname);
         $data ['image'] = 'public/files/campaign/' .$photoname;
         $data ['month'] = date('F');
         $data ['year'] = date('Y');
         $data ['created_at'] = Carbon::now();
         $data ['updated_at'] = Carbon::now();
         DB::table('campaigns')->insert($data);
         return response()->json('Campaign Create Sucessfull !');
    }

    //campaign data edit method
    public function edit($id){
        $data = DB::table('campaigns')->where('id', $id)->first();
        return view("admin.offer.campaign.edit", compact('data'));
    }

    //campaign data update method
    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $slug = Str::slug($request->name, '-');
        $data ['name'] = $request->name;
        $data ['slug'] = Str::slug($request->name, '-');
        $data ['start_date'] = $request->start_date;
        $data ['end_date'] = $request->end_date;
        $data ['status'] = $request->status;
        $data ['discount'] = $request->discount;
        // $data['front_page']=$request->front_page;
        if ($request->image) {
            if (File::exists($request->old_logo)) {
            unlink($request->old_logo);
        }
            $photo = $request->image;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            // $photo->move('public/files/brand', $photoname); //without image intervention
            Image::make($photo)->resize(240,120)->save('public/files/campaign/'.$photoname);
            $data ['image'] = 'public/files/campaign/'.$photoname;
            $data ['updated_at'] = Carbon::now();
            DB::table('campaigns')->where('id', $id)->update($data);
            return response()->json('Campaign Update Sucessfull!');
        }else{
            $data ['image'] = $request->old_logo;
            $data ['month'] = date('F');
            $data ['year'] = date('Y');
            $data ['updated_at'] = Carbon::now();
            DB::table('campaigns')->where('id', $id)->update($data);
            return response()->json('Campaign Update Sucessfull!');
        }
    }

    //campaign data delete method
    public function destroy($id){
        $data = DB::table('campaigns')->where('id', $id)->first();
        $image = $data->image;
        if (File::exists($image)) {
            unlink($image);
            DB::table('campaigns')->where('id', $id)->delete();
            return response()->json('Campaign Delete Sucessfull!');
        }
    }
}
