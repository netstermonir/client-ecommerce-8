@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product</li>
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
       <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" id="form">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="p_name">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" id="p_name"  required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="p_code">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control"  name="code" id="p_code" required="">
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
                            <option value="{{ $row->id }}"> 🢆 {{ $row->subcat_name }}</option>
                          @endforeach
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="childcategory_id">Child category<span class="text-danger">*</span> </label>
                      <select class="form-control" name="childcategory_id" id="childcategory_id">
                         
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="brand_id">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id" id="brand_id">
                        <option disabled selected="">⇿ choose Brand ⇿</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point_id">
                       <option disabled selected="">⇿ choose pickup-point ⇿</option>
                        @foreach($pickup as $row)
                          <option value="{{ $row->id }}">{{ $row->pickup_point_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="p_unit">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="unit" id="p_unit" required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="product_tag">Tags</label><br>
                      <input type="text" name="tags" class="demo-default selectized" name="tags" id="product_tag">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="p_price">Purchase Price  </label>
                      <input type="text" class="form-control"  name="purchase_price" id="p_price">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="p_s_price">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price" id="p_s_price" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="d_price">Discount Price </label>
                      <input type="text" name="discount_price" id="d_price"  class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="warehouse_id">Warehouse <span class="text-danger">*</span> </label>
                      <select class="form-control" name="warehouse_id" id="warehouse_id">
                       <option disabled selected="">⇿ choose Warehouse ⇿</option>
                        @foreach($warehouse as $row)
                          <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="stock_quantity">Stock</label>
                      <input type="text" name="stock_quantity" id="stock_quantity"  class="form-control">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="color">Color</label><br>
                      <input type="text" class="demo-default selectized" name="color" id="color" />
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="size">Size</label><br>
                      <input type="text" class="demo-default selectized" name="size" id="size" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="summernote">Product Details <span class="text-danger">*</span></label>
                      <textarea class="form-control textarea" id="summernote" name="description"></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="video">Video Embed Code</label>
                      <textarea class="form-control" name="video" id="video" placeholder="Only code after embed word"></textarea>
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
                    <input type="file" name="thumbnail" required="" accept="image/*" class="dropify">
                  </div><br>
                  <div class="">  
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <h3 class="card-title">More Images (Click Add For More Image)</h3>
                    </div> 
                      <tr>  
                          <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>  
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                      </tr>  
                    </table>    
                  </div>
                     <div class="card p-4">
                        <h6>Featured Product</h6>
                       <input type="checkbox" name="featured" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Today Deal</h6>
                       <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Slider Product</h6>
                       <input type="checkbox" name="product_slider" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Trendy Product</h6>
                       <input type="checkbox" name="trendy_product" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
           <button class="btn btn-info ml-2" type="submit" id="submit"><span class="d-none loader">...Loading...</span><span class="btn_submit">Submit</span></button>
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

     //product insert method
    $(function(){
      // $.ajaxSetup({
      //   headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      //   });
        $('#form').on('submit', function(e){
            e.preventDefault();
            $('.loading').removeClass('d-none');
            var form_data = this;
            $.ajax({
                url:$(form_data).attr('action'),
                method:$(form_data).attr('method'),
                data:new FormData(form_data),
                processData:false,
                dataType:'json',
                contentType:false,
                success:function(data){
                  $('.loading').addClass('d-none');
                  toastr.success(data);
                  $('#form')[0].reset();
                }
            });
        });
    });
</script>
@endsection