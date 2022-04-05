<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use Image;
use DataTables;
use File;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    //product show with yajra
    public function index(Request $request){
        // yajra DataTables
        if ($request->ajax()) {
            $imgUrl = 'public/files/product';
            $product = "";
            $query = DB::table('products')->leftJoin('categories','products.category_id','categories.id')->leftJoin('subcategories','products.subcategory_id','subcategories.id')->leftJoin('brands','products.brand_id','brands.id');
                if ($request->category_id) {
                    $query->where('products.category_id',$request->category_id);
                 }

                if ($request->brand_id) {
                    $query->where('products.brand_id',$request->brand_id);
                }

                if ($request->warehouse_id) {
                    $query->where('products.warehouse_id',$request->warehouse_id);
                }

                if ($request->status==1) {
                    $query->where('products.status',1);
                }
                if ($request->status==0) {
                    $query->where('products.status',0);
                }

            $product = $query->select('products.*','categories.category_name','subcategories.subcat_name','brands.brand_name')
                    ->get();
            return DataTables::of($product)->addIndexColumn()
            ->editColumn('thumbnail', function($row) use($imgUrl){
                return '<img src="'.$imgUrl.'/'.$row->thumbnail.'" height="30" width="30" alt=""/>';
            })
            ->editColumn('featured', function($row){
                if ($row->featured == 1) {
                    return '<a href="" class="deactive_featured" data-id="'.$row->id.'"><i class="fas fa-thumbs-up text-success"></i>  <span class="badge badge-success">Active</span></a>';
                }
                else{
                    return '<a href="" class="active_featured" data-id="'.$row->id.'"><i class="fas fa-thumbs-down text-danger"></i>  <span class="badge badge-danger">Inactive</span></a>';
                }
            })
            ->editColumn('today_deal', function($row){
                if ($row->today_deal == 1) {
                    return '<a href="#" class="deactive_deal" data-id="'.$row->id.'"><i class="fas fa-thumbs-up text-success"></i>  <span class="badge badge-success">Active</span></a>';
                }
                else{
                    return '<a href="#" class="active_deal" data-id="'.$row->id.'"><i class="fas fa-thumbs-down text-danger"></i>  <span class="badge badge-danger">Inactive</span></a>';
                }
            })
            ->editColumn('status', function($row){
                if ($row->status == 1) {
                    return '<a href="#" class="deactive_status" data-id="'.$row->id.'"><i class="fas fa-thumbs-up text-success"></i>  <span class="badge badge-success">Active</span></a>';
                }
                else{
                    return '<a href="#" class="active_status" data-id="'.$row->id.'"><i class="fas fa-thumbs-down text-danger"></i>  <span class="badge badge-danger">Inactive</span></a>';
                }
            })
            ->addColumn('action', function($row){
                $actionbtn = '
                    <a href="'.route('product.edit', [$row->id]).'" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-info btn-sm show"><i class="fas fa-eye"></i></a>
                    <a href="'.route('product.delete', [$row->id]).'" id="product_delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
            })->rawColumns(['action', 'thumbnail', 'category_name', 'subcat_name', 'brand_name', 'featured', 'today_deal', 'status'])->make(true);
        }
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.index', compact('category', 'brand', 'warehouse'));
    }

    //product create method
    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $pickup = DB::table('pickup_points')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.create', compact('category', 'brand', 'pickup', 'warehouse'));
    }

    //product store method
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
        ]);

        //sucategory id call form category id
        $subcat = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        $slug = Str::slug($request->name, '-');
        $data = array();
        $data ['name'] = $request->name;
        $data ['slug'] = Str::slug($request->name, '-');
        $data ['code'] = $request->code;
        $data ['category_id'] = $subcat->category_id;
        $data ['subcategory_id'] = $request->subcategory_id;
        $data ['childcategory_id'] = $request->childcategory_id;
        $data ['brand_id'] = $request->brand_id;
        $data ['pickup_point_id'] = $request->pickup_point_id;
        $data ['unit'] = $request->unit;
        $data ['tags'] = $request->tags;
        $data ['purchase_price'] = $request->purchase_price;
        $data ['selling_price'] = $request->selling_price;
        $data ['discount_price'] = $request->discount_price;
        $data ['warehouse_id'] = $request->warehouse_id;
        $data ['stock_quantity'] = $request->stock_quantity;
        $data ['color'] = $request->color;
        $data ['size'] = $request->size;
        $data ['description'] = $request->description;
        $data ['video'] = $request->video;
        $data ['featured'] = $request->featured;
        $data ['today_deal'] = $request->today_deal;
        $data ['product_slider'] = $request->product_slider;
        $data ['status'] = $request->status;
        $data ['admin_id'] = Auth::id();
        $data ['date'] = date('d-m-Y');
        $data ['day'] = date('D');
        $data ['month'] = date('F');
        $data ['year'] = date('Y');

        //work with single thumbnail
        if ($request->thumbnail) {
            $thumbnail = $request->thumbnail;
            $photoname = $slug.'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600,600)->save('public/files/product/' .$photoname);
            $data ['thumbnail'] = $photoname;
        }

        //multiple images
        $images = array();
        if($request->hasFile('images')){
           foreach ($request->file('images') as $key => $image) {
               $imageName= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(600,600)->save('public/files/product/'.$imageName);
               array_push($images, $imageName);
           }
           $data['images'] = json_encode($images);
       }
       $data ['created_at'] = Carbon::now();
       $data ['updated_at'] = Carbon::now();
       DB::table('products')->insert($data);
       return response()->json('Product Create Sucessfull');
    }

    //product not featured method
    public function notfeatured($id){
        DB::table('products')->where('id', $id)->update(['featured'=>0]);
        return response()->json('Product Featured Deactive Successfull !');
    }

    //product featured active method
    public function featured($id){
        DB::table('products')->where('id', $id)->update(['featured'=>1]);
        return response()->json('Product Featured Active Successfull !');
    }

    //product not deal method
    public function notdeal($id){
        DB::table('products')->where('id', $id)->update(['today_deal'=>0]);
        return response()->json('Product Today Deal Deactive Successfull !');
    }

    //product featured active method
    public function deal($id){
        DB::table('products')->where('id', $id)->update(['today_deal'=>1]);
        return response()->json('Product Today Deal Active Successfull !');
    }

    //product status not active method
    public function notstatus($id){
        DB::table('products')->where('id', $id)->update(['status'=>0]);
        return response()->json('Product Status Deactive Successfull !');
    }

    //product featured active method
    public function status($id){
        DB::table('products')->where('id', $id)->update(['status'=>1]);
        return response()->json('Product Status Active Successfull !');
    }

    //product edit method
    public function edit($id){
        $product = DB::table('products')->where('id', $id)->first();
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')->get();
        $brand = DB::table('brands')->get();
        $pickup = DB::table('pickup_points')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.edit', compact('product', 'category', 'subcat', 'brand', 'pickup', 'warehouse'));
    }

    //product delete method
    public function destroy($id){
        // $data = DB::table('products')->where('id', $id)->first();
        // $main_image = $data->thumbnail;
        // $image = $data->images;
        // if (File::exists($main_image || $image)) {
        //     unlink($main_image || $image);
        //     DB::table('products')->where('id', $id)->delete();
        //     return response()->json('Product Delete Successfull !');
        // }
        DB::table('products')->where('id', $id)->delete();
        return response()->json('Product Delete Successfull !');
    }
}
