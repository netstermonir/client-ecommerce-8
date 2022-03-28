@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pickup Point</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('pickuppoint.store') }}" method="POST" id="add_form">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="pickup_point_name">Pickup Point Name</label>
                      <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" placeholder="Pickup Point Name" required>
                    </div>
                    <div class="form-group">
                      <label for="pickup_point_address">Pickup Point Address</label>
                      <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" placeholder="Pickup Point Address" required>
                    </div>
                    <div class="form-group">
                      <label for="pickup_point_phone">Pickup Point Phone</label>
                      <input type="number" class="form-control" id="pickup_point_phone" name="pickup_point_phone" placeholder="Pickup Point Phone" required>
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
                <h3 class="card-title">All Pickup Point</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Pickup Name</th>
                    <th>Pickup Address</th>
                    <th>Pickup Phone</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
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
  		ajax:"{{ route('pickuppoint.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'pickup_point_name', name: 'pickup_point_name'},
  			{data: 'pickup_point_address', name: 'pickup_point_address'},
  			{data: 'pickup_point_phone', name: 'pickup_point_phone'},
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
    $.get("pickup-point/edit/"+id, function(data){
      $('#modal_body').html(data);
    });
});

// cupon delete with ajax
$(document).ready(function(){
  $(document).on('click', '#delete_pickup',function(e){
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