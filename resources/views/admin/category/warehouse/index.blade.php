@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Warehouse</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New Warehouse</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('warehouse.store') }}" method="POST" id="add_form">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="warehouse_name">Warehouse Name</label>
                      <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" placeholder="Enter Warehouse Name" required>
                    </div>
                    <div class="form-group">
                      <label for="warehouse_address">Warehouse Addewss</label>
                      <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" placeholder="Enter Warehouse Address" required>
                    </div>
                    <div class="form-group">
                      <label for="warehouse_phone">Warehouse Phone</label>
                      <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" placeholder="Enter Warehouse Phone" required>
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
                    <th>Warehouse Name</th>
                    <th>Warehouse Address</th>
                    <th>Warehouse Phone</th>
                    <th>Action</th>
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
 <!--category edit Modal -->
<div class="modal fade" id="categoryeditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
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
  	var table = $('.ytable').DataTable({
  		processing: true,
  		serverSide: true,
  		ajax:"{{ route('warehouse.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'warehouse_name', name: 'warehouse_name'},
  			{data: 'warehouse_address', name: 'warehouse_address'},
  			{data: 'warehouse_phone', name: 'warehouse_phone'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });

  //add data
  $('#add_form').on('submit', function(){
  	$('.loader ').removeClass('d-none');
  	$('.btn_submit').addClass('d-none');
  })
//edit 
$('body').on('click', '.edit', function(){
    let id = $(this).data('id');
    $.get("warehouse/edit/"+id, function(data){
      $('#modal_body').html(data);
    });
  });
</script>
@endsection