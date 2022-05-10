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
                <div class="col-md-3">
                  <div class="form-group">
                    <button class="btn btn-primary btn-sm print" style="float:right"><span class="loading d-none">Loading...</span>Print Order</button>
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
                  </tr>
                  </thead>
                  <tbody>
           
                  </tbody>
                </table>
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
        "url": "{{ route('order.report.index') }}", 
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
</script>
{{-- order print report --}}
<script type="text/javascript">
	$('.print').on('click', function(e){
	    e.preventDefault();
	    $('.loading').removeClass('d-none');
	    $.ajax({
	      url:"{{ route('report.order.print') }}",
	      type:'get',	      
	      data:{status : $('#status').val(), date : $('#date').val(), payment_type : $('#payment_type').val()},
	      success:function(data){
	        $('.loading').addClass('d-none');
	        $(data).printThis({
	        	debug: false,
	        	importCSS: true,
	        	importStyle: true,
	        	removeInline: false,
	        	printDelay: 500,
	        	header: null,
	        	footer: null,
	        });
	      }
	    });
  	});
</script>
@endsection