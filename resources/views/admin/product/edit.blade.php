@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('product.update') }}" method="post" enctype="multipart/form-data" id="add_form">
        @csrf
       	<div class="row">
          <input type="hidden" name="id" value="{{ $product->id }}">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="p_name">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ $product->name }}" id="p_name"  required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="p_code">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control"  name="code" value="{{ $product->code }}" id="p_code" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="subcategory_id">Category/Subcategory <span class="text-danger">*</span> </label>
                      <select class="form-control" name="subcategory_id" id="subcategory_id">
                        <option disabled selected="">⇿ choose category ⇿</option>
                        @foreach($category as $row)
                        @php
                          $subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
                        @endphp
                          <option class="text-muted" disabled>{{ $row->category_name }}</option>
                          @foreach($subcat as $row)
                            <option value="{{ $row->id }}" @if($row->id == $product->subcategory_id) selected @endif> 🢆 {{ $row->subcat_name }}</option>
                          @endforeach
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="childcategory_id">Child category<span class="text-danger">*</span> </label>
                      <select class="form-control" name="childcategory_id" id="childcategory_id">
                         @foreach($childcat as $child)
                          <option value="{{ $child->id }}" @if($child->id == $product->childcategory_id) selected @endif> 🢆 {{ $child->childcategory_name }}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="brand_id">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id" id="brand_id">
                        <option disabled selected="">⇿ choose Brand ⇿</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}" @if($row->id == $product->brand_id) selected @endif>{{ $row->brand_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point_id">
                       <option disabled selected="">⇿ choose pickup-point ⇿</option>
                        @foreach($pickup as $row)
                          <option value="{{ $row->id }}" @if($row->id == $product->pickup_point_id) selected @endif>{{ $row->pickup_point_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="p_unit">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="unit" value="{{ $product->unit }}" id="p_unit" required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="product_tag">Tags</label><br>
                      <input type="text" name="tags" class="demo-default selectized" name="tags" id="product_tag" value="{{ $product->tags }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="p_price">Purchase Price  </label>
                      <input type="text" class="form-control"  name="purchase_price" id="p_price" value="{{ $product->purchase_price }}">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="p_s_price">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price" id="p_s_price" class="form-control" required="" value="{{ $product->selling_price }}">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="d_price">Discount Price </label>
                      <input type="text" name="discount_price" value="{{ $product->discount_price }}" id="d_price"  class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="warehouse_id">Warehouse <span class="text-danger">*</span> </label>
                      <select class="form-control" name="warehouse_id" id="warehouse_id">
                       <option disabled selected="">⇿ choose Warehouse ⇿</option>
                        @foreach($warehouse as $row)
                          <option value="{{ $row->id }}" @if($row->id == $product->warehouse_id) selected @endif>{{ $row->warehouse_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="stock_quantity">Stock</label>
                      <input type="text" name="stock_quantity" id="stock_quantity"  class="form-control" value="{{ $product->stock_quantity }}">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="color">Color</label><br>
                      <input type="text" class="demo-default selectized" name="color" value="{{ $product->color }}" id="color" />
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="size">Size</label><br>
                      <input type="text" class="demo-default selectized" name="size" value="{{ $product->size }}" id="size" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="summernote">Product Details <span class="text-danger">*</span></label>
                      <textarea class="form-control textarea" id="summernote" name="description">{{ $product->description }}</textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="video">Video Embed Code</label>
                      <textarea class="form-control" name="video" id="video" placeholder="Only code after embed word">{{ $product->video }}</textarea>
                      <small class="text-danger">Only code after embed word</small>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
            <!-- /.card -->
          <!-- right column -->
          <div class="col-md-4">
            <!-- Form Element sizes -->
            <div class="card card-primary">
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                    <input type="file" name="thumbnail" accept="image/*" class="dropify">
                  </div><br>
                  <h3 class="card-title text-center">Old Thumbnail Image</h3>
                  <div class="row">
                    <div class="col-md-12 thum_image">
                      <img src="{{ asset('public/files/product/'.$product->thumbnail) }}" style="padding:10px; width: 80%; height:80px">
                      <input type="hidden" name="old_thumbnail" value="{{ $product->thumbnail }}">
                      <button type="button" class="remove_old_files" style="border: none; display: contents; color: white; background-color: gray;">X</button>
                    </div>
                  </div>
                  <div class="">  
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <h3 class="card-title">More Images (Click Add For More Image)</h3>
                    </div> 
                      <tr>  
                          <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                      </tr>  
                      @php
                        $images = json_decode($product->images, true);
                      @endphp
                      @if($images)
                        <div class="row">
                          @foreach($images as $key=>$image)
                            <div class="col-md-4 edit_image">
                              <img src="{{ asset('public/files/product/'.$image) }}" style="padding:10px; width: 70px; height:80px">
                              <input type="hidden" name="old_images[]" value="{{ $image }}">
                              <button type="button" class="remove_files" style="border: none; display: contents; color: white;">X</button>
                            </div>
                          @endforeach
                        </div>
                      @else
                      @endif
                    </table>    
                  </div>
                     <div class="card p-4">
                        <h6>Featured Product</h6>
                       <input type="checkbox" name="featured" value="1" @if($product->featured == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Today Deal</h6>
                       <input type="checkbox" name="today_deal" value="1" @if($product->today_deal == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Slider Product</h6>
                       <input type="checkbox" name="product_slider" value="1" @if($product->product_slider == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Trendy Product</h6>
                       <input type="checkbox" name="trendy_product" value="1" @if($product->trendy_product == 1) checked @endif  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" @if($product->status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
           <button class="btn btn-info ml-2" type="submit">Submit</button>
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="{{ asset('public/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

<script type="text/javascript">
  $('.dropify').dropify(); 
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  $(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;
       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       });
       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
     }); 

  // reomove image
  $('.remove_files').on('click', function(){  
      $(this).parents('.edit_image').remove();
  });
  $('.remove_old_files').on('click', function(){  
      $(this).parents('.thum_image').remove();
  }); 
  //ajax request send for collect childcategory
     $("#subcategory_id").change(function(){
      var id = $(this).val();
      $.ajax({
           url: "{{ url("/get-child-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="childcategory_id"]').empty();
                   $.each(data, function(key,data){
                      $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                });
           }
        });
     });
</script>
@endsection