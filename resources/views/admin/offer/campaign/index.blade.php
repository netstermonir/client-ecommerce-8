@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModal">+ Add New</button>

               <!--category insert Modal -->
              <section>
                <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('campaign.store') }}" method="POST" id="add_form" enctype="multipart/form-data">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="campaign_name">Campaign Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="campaign_name" name="name" aria-describedby="campaign" placeholder="Enter Campaign Name" required>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <label for="start_date">Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" aria-describedby="start_date" required>
                      </div>
                      <div class="col-lg-6">
                        <label for="end_date">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" aria-describedby="end_date" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <label for="start_date">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                      <div class="col-lg-6">
                        <label for="discount">Discount(%) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="discount" name="discount" aria-describedby="discount" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="image">Campaign Logo <span class="text-danger">*</span></label>
                      <input type="file" class="form-control dropify" data-height="140" accept="image/*" name="image" aria-describedby="image" required>
                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary"><span class="d-none">...Loading...</span> Save</button>
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
                <h3 class="card-title">All Campaign</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Campaign Name</th>
                    <th>Campaign Logo</th>
                    <th>Discount(%)</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
           
                  </tbody>
                </table>
                {{-- delete form --}}
                <form id="deleted_form" action="" method="POST">
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
 <script type="text/javascript">
 	$('.dropify').dropify({
 		messages: {
        'default': 'Drag and drop or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
 	});
 </script>
<script type="text/javascript">
  $(function childCategory(){
  	table = $('.ytable').DataTable({
  		processing: true,
  		serverSide: true,
  		ajax:"{{ route('campaign.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'name', name: 'name'},
        {data: 'image', name: 'image', render: function(data, type, full, meta){
          return "<img src=\""+data+"\" height=\"30\" />"
        }},
        {data: 'discount', name: 'discount'},
  			{data: 'start_date', name: 'start_date'},
        {data: 'end_date', name: 'end_date'},
        {data: 'status', name: 'status'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });

    //add campaign data ajax
  $(function(){
        $('#add_form').on('submit', function(e){
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
                  toastr.success(data);
                  $('#add_form')[0].reset();
                  $('.loading').addClass('d-none');
                  $('#insertModal').modal('hide');
                  table.ajax.reload();
                }
            });
        });
    });
  	//edit 
	$('body').on('click', '.edit', function(){
	    let id = $(this).data('id');
	    $.get("campaign/edit/"+id, function(data){
	      $('#modal_body').html(data);
	    });
	  });
  // cupon delete with ajax
$(document).ready(function(){
  $(document).on('click', '#campaign_delete',function(e){
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