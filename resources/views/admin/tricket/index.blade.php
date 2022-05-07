@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tricket List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
                <h3 class="card-title">All Tricket</h3>
              </div>
              <div class="row" style="padding: 1.25rem;">
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="type" id="type">
                      	<option value="">⇿ Fillter With Type ⇿</option>
                     	<option value="Technical">Technical</option>
           	      		<option value="Payment">Payment</option>
           	      		<option value="Order">Order</option>
           	      		<option value="Return">Return</option>
           	      		<option value="Affiliate">Affiliate</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="status" id="status">
                      <option>⇿ Fillter With Status ⇿</option>
                        <option value="0">Pending</option>
                        <option value="1">Replied</option>
                        <option value="2">Closed</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input type="date" name="date" id="date" class="form-control submitable_input">
                    <small class="text-center mx-auto">⇿ Fillter With Date ⇿</small>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Service</th>
                    <th>Priority</th>
                    <th>Date</th>
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
        "url": "{{ route('tricket.index') }}", 
        "data":function(e) {
          e.type =$("#type").val();
          e.status =$("#status").val();
          e.date =$("#date").val();
        }
      },
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'name', name: 'name'},
  			{data: 'subject', name: 'subject'},
  			{data: 'service', name: 'service'},
  			{data: 'priority', name: 'priority'},
  			{data: 'date', name: 'date'},
  			{data: 'status', name: 'status'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });
</script>
<script type="text/javascript">
  //realtime filltering
  $(document).on('change', '.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });
  //realtime filltering
  $(document).on('change', '.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  //delete product
  $(document).ready(function(){
  $(document).on('click', '#tricket_delete',function(e){
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