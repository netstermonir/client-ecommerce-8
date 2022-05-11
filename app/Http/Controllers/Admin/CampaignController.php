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
                    <a href="'.route('campaign.delete', [$row->id]).'" id="campaign_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    <a href="'.route('campaign.product', [$row->id]).'" class="btn btn-success btn-sm"><i class="fas fa-plus"> Add</i></a>
                    ';
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

    //capmpaign product all show
    public function campaignProduct($campaign_id)
    {
        $product = DB::table('products')->leftJoin('categories','products.category_id','categories.id')->leftJoin('subcategories','products.subcategory_id','subcategories.id')->leftJoin('brands','products.brand_id','brands.id')->select('products.*','categories.category_name','subcategories.subcat_name','brands.brand_name')->where('products.status', 1)->get();
        return view('admin.offer.campaign.campaign_product.index', compact('product', 'campaign_id'));
    }

    //campaign product store
    public function campaignProductstore($id, $campaign_id)
    {
        $campaign = DB::table('campaigns')->where('id', $campaign_id)->first();
        $product = DB::table('products')->where('id', $id)->first();
        $discount = $product->selling_price/100*$campaign->discount;
        $discount_price = $product->selling_price-$discount;
        $data = [];
        $data ['product_id'] = $id;
        $data ['campaign_id'] = $campaign_id;
        $data ['price'] = $discount_price;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('campaign_product')->insert($data);
        $notify = array('messege' => 'Campaign Product Added Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }

    //campaign product list
    public function campaignProductList($campaign_id)
    {
        $product = DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')->select('products.*','campaign_product.*')->where('campaign_product.campaign_id', $campaign_id)->get();
        $campaign = DB::table('campaigns')->where('id', $campaign_id)->first();
        return view('admin.offer.campaign.campaign_product.product_list', compact('product', 'campaign'));
    }

    //campaign product delete
    public function campaignProductdelete($id)
    {
        DB::table('campaign_product')->where('id', $id)->delete();
        $notify = array('messege' => 'Campaign Product Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
