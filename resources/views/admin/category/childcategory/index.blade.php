@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ChildCategory</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New ChildCategory</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('childcategory.store') }}" method="POST" id="add_form">
                      @csrf
                    <div class="modal-body">
                      <div class="form-group">
                      <label for="subcategory_id">Category/SubCategory Name</label>
                      <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                        @foreach($category as $row)
                        @php
                        	$subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
                        @endphp
                        	<option value="{{ $row->id }}" disabled="" style="color: white;">{{ $row->category_name }}</option>
                        @foreach($subcat as $row)
                        	<option value="{{ $row->id }}"> -- {{ $row->subcat_name }}</option>
                        @endforeach
                        @endforeach
                      </select>
                      <small id="cat" class="form-text text-muted">This is Main Category</small>
                    </div>
                    <div class="form-group">
                      <label for="childcategory_name">ChildCategory Name</label>
                      <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" aria-describedby="subcat" placeholder="Enter SubCategory Name" required>
                      <small id="subcat" class="form-text text-muted">This is Child Category</small>
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
                <h3 class="card-title">All ChildCategory</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>ChildCategory Name</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit ChildCategory</h5>
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
  		ajax:"{{ route('childcategory.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'childcategory_name', name: 'childcategory_name'},
  			{data: 'category_name', name: 'category_name'},
  			{data: 'subcat_name', name: 'subcat_name'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });
//edit 
$('body').on('click', '.edit', function(){
    let id = $(this).data('id');
    $.get("childcategory/edit/"+id, function(data){
      $('#modal_body').html(data);
    });
  });
</script>
@endsection