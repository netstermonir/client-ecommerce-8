@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">+ Add New</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Product</h3>
              </div>
              <div class="row" style="padding: 1.25rem;">
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="category_id" id="category_id">
                      <option value="">⇿ Fillter With Category ⇿</option>
                      @foreach($category as $row)
                        <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="brand_id" id="brand_id">
                      <option value="">⇿ Fillter With Brand ⇿</option>
                      @foreach($brand as $row)
                        <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
                      <option value="">⇿ Fillter With Warehouse ⇿</option>
                      @foreach($warehouse as $row)
                        <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="status" id="status">
                      <option>⇿ Fillter With Status ⇿</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>SubCat</th>
                    <th>Brand</th>
                    <th>Featured</th>
                    <th>Deal</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
           
                  </tbody>
                </table>
                {{-- delete form --}}
                <form id="deleted_form" action="" method="post">
                  @method('DELETE')
                  @csrf
                 </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
</section>
  </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function childCategory(){
      table=$('.ytable').DataTable({
  		"processing":true,
      "serverSide":true,
      "searching":true,
      "ajax":{
        "url": "{{ route('product.index') }}", 
        "data":function(e) {
          e.category_id =$("#category_id").val();
          e.brand_id =$("#brand_id").val();
          e.status =$("#status").val();
          e.warehouse_id =$("#warehouse_id").val();
        }
      },
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'thumbnail', name: 'thumbnail'},
  			{data: 'name', name: 'name'},
  			{data: 'code', name: 'name'},
  			{data: 'category_name', name: 'category_name'},
  			{data: 'subcat_name', name: 'subcat_name'},
  			{data: 'brand_name', name: 'brand_name'},
  			{data: 'featured', name: 'featured'},
  			{data: 'today_deal', name: 'today_deal'},
  			{data: 'status', name: 'status'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });
</script>
<script type="text/javascript">
	//featured deactive 
	$('body').on('click', '.deactive_featured', function(e){
		e.preventDefault();
	    let id = $(this).data('id');
	    let url = "{{ url('product/not-featured') }}/"+id;
	    $.ajax({
	    	url:url,
	    	type:'get',
	    	success:function(data){
	    		toastr.success(data);
		      table.ajax.reload();
	    	}
	    })
	});
	//featured active 
	$('body').on('click', '.active_featured', function(e){
		e.preventDefault();
	    let id = $(this).data('id');
	    let url = "{{ url('product/featured') }}/"+id;
	    $.ajax({
	    	url:url,
	    	type:'get',
	    	success:function(data){
	    		toastr.success(data);
		      table.ajax.reload();
	    	}
	    })
	});
    //deal deactive 
  $('body').on('click', '.deactive_deal', function(e){
    e.preventDefault();
      let id = $(this).data('id');
      let url = "{{ url('product/not-deal') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          toastr.success(data);
          table.ajax.reload();
        }
      })
  });
    //deal active 
  $('body').on('click', '.active_deal', function(e){
    e.preventDefault();
      let id = $(this).data('id');
      let url = "{{ url('product/deal') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          toastr.success(data);
          table.ajax.reload();
        }
      })
  });
    //status deactive 
  $('body').on('click', '.deactive_status', function(e){
    e.preventDefault();
      let id = $(this).data('id');
      let url = "{{ url('product/not-status') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          toastr.success(data);
          table.ajax.reload();
        }
      })
  });
  //status active 
  $('body').on('click', '.active_status', function(e){
    e.preventDefault();
      let id = $(this).data('id');
      let url = "{{ url('product/status') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          toastr.success(data);
          table.ajax.reload();
        }
      })
  });
  //realtime filltering
  $(document).on('change', '.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  //delete product
  $(document).ready(function(){
  $(document).on('click', '#product_delete',function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    $("#deleted_form").attr('action',url);
    Swal.fire({
        title: 'Are you Want to Delete?',
        text: "You Sure Now!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
    }).then((result) => {
      if (result.isConfirmed) {
        $("#deleted_form").submit();
      }
      else{
        swal.fire("Safe Data!");
      }
    })
  });

    //data passed through here
    $('#deleted_form').submit(function(e){
      e.preventDefault();
      var form_data = this;
      $.ajax({
        url:$(form_data).attr('action'),
        method:$(form_data).attr('method'),
        data:new FormData(form_data),
        async:false,
        processData:false,
        contentType:false,
        success:function(data){
          toastr.success(data);
          $('#deleted_form')[0].reset();
           table.ajax.reload();
        }
      });
    });
  });
</script>
@endsection