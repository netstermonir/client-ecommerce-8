@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cupon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModal">+ Add New</button>

               <!--category insert Modal -->
              <section>
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add New Cupon</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('cupon.store') }}" method="POST" id="add_form">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="coupon_code">Cupon Code</label>
                      <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Cupon Code" required>
                    </div>
                    <div class="form-group">
                      <label for="type">Cupon Type</label>
                      <select class="form-control" name="type" id="type" required>
                      	<option value="1">Fixed</option>
                      	<option value="2">Percentage</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="status">Cupon Status</label>
                      <select class="form-control" name="status" id="status" required>
                      	<option value="Active">Active</option>
                      	<option value="Inactive">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="number" class="form-control" id="amount" name="coupon_amount" placeholder="Cupon Amount" required>
                    </div>
                    <div class="form-group">
                      <label for="date">Valid Date</label>
                      <input type="date" class="form-control" id="date" name="valid_date" required>
                    </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Save</span></button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              </section>
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
                <h3 class="card-title">All Warehouse</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Cupon Code</th>
                    <th>Cupon Amount</th>
                    <th>Cupon Date</th>
                    <th>Cupon Status</th>
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
 <!--category edit Modal -->
<div class="modal fade" id="categoryeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Cupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body">
        
      </div>
    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function childCategory(){
  	 	table = $('.ytable').DataTable({
  		processing: true,
  		serverSide: true,
  		ajax:"{{ route('cupon.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'coupon_code', name: 'coupon_code'},
  			{data: 'coupon_amount', name: 'coupon_amount'},
  			{data: 'valid_date', name: 'valid_date'},
  			{data: 'status', name: 'status'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });

  //add cupon data ajax
  $('#add_form').submit(function(e){
    e.preventDefault();
    $('.loading').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#insertModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
//edit 
$('body').on('click', '.edit', function(){
    let id = $(this).data('id');
    $.get("cupon/edit/"+id, function(data){
      $('#modal_body').html(data);
    });
});

// cupon delete with ajax
$(document).ready(function(){
  $(document).on('click', '#delete_coupon',function(e){
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
      var url = $(this).attr('action');
      var request =$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
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