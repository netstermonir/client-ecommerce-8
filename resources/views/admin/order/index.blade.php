@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
{{--             <ol class="breadcrumb float-sm-right">
              <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">+ Add New</a>
            </ol> --}}
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
                <h3 class="card-title">All Orders</h3>
              </div>
              <div class="row" style="padding: 1.25rem;">
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="payment_type" id="payment_type">
                      	<option value="">⇿ Fillter With Payment Type ⇿</option>
                        <option value="Hand Cash">Hand Cash</option>
                        <option value="Aamarpay">Aamarpay</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control submitable" name="status" id="status">
                      	<option>⇿ Fillter With Status ⇿</option>
                        <option value="0">Pending</option>
                        <option value="1">Received</option>
                        <option value="2">Shipped</option>
                        <option value="3">Completed</option>
                        <option value="4">Return</option>
                        <option value="5">Cencel</option>
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
                    <th>Phone</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Payment Type</th>
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
  <div class="modal fade" id="categoryeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body">
        
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="ShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="show_modal_body">
        
      </div>
    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script type="text/javascript">
     //edit modal
      $('body').on('click','.edit', function(){
        var id=$(this).data('id');
        var url = "{{ url('order/edit') }}/"+id;
        $.ajax({
          url:url,
          type:'get',
          success:function(data){  
               $("#modal_body").html(data);
            }
        });
        });
      //show modal order
      $('body').on('click','.show', function(){
        var id=$(this).data('id');
        var url = "{{ url('order/view') }}/"+id;
        $.ajax({
          url:url,
          type:'get',
          success:function(data){  
               $("#show_modal_body").html(data);
            }
        });
        });
 </script>
<script type="text/javascript">
  $(function childCategory(){
      table=$('.ytable').DataTable({
  		"processing":true,
      "serverSide":true,
      "searching":true,
      "ajax":{
        "url": "{{ route('admin.orders.index') }}", 
        "data":function(e) {
          e.status =$("#status").val();
          e.date =$("#date").val();
          e.payment_type =$("#payment_type").val();
        }
      },
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'c_name', name: 'c_name'},
  			{data: 'c_phone', name: 'c_phone'},
  			{data: 'subtotal', name: 'subtotal'},
  			{data: 'total', name: 'total'},
  			{data: 'payment_type', name: 'payment_type'},
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
 //realtime filltering date
  $(document).on('change', '.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
  });




  //delete product
  $(document).ready(function(){
  $(document).on('click', '#order_delete',function(e){
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