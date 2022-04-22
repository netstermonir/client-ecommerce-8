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
            <h1 class="m-0">Brand</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('brand.store') }}" method="POST" id="add_form" enctype="multipart/form-data">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="brand_name">Brand Name</label>
                      <input type="text" class="form-control" id="brand_name" name="brand_name" aria-describedby="brand" placeholder="Enter Brand Name" required>
                      <small id="brand" class="form-text text-muted">This is Brand Name</small>
                    </div>
                    <div class="form-group">
                      <label for="front_page">Home Brand</label>
                      <select class="form-control" name="front_page">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                      <small class="form-text text-muted">If yes it will be show on your home page</small>
                    </div>
                    <div class="form-group">
                      <label for="brand_logo">Brand Logo</label>
                      <input type="file" class="form-control dropify" data-height="140" id="brand_logo" name="brand_logo" aria-describedby="brand_logo" required>
                      <small id="brand_logo" class="form-text text-muted">This is Brand Logo</small>
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
                <h3 class="card-title">All Brand</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Brand Name</th>
                    <th>Brand Slug</th>
                    <th>Brand Logo</th>
                    <th>Brand Home</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
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
  	var table = $('.ytable').DataTable({
  		processing: true,
  		serverSide: true,
  		ajax:"{{ route('brand.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'brand_name', name: 'brand_name'},
  			{data: 'brand_slug', name: 'brand_slug'},
  			{data: 'brand_logo', name: 'brand_logo', render: function(data, type, full, meta){
  				return "<img src=\""+data+"\" height=\"30\" />"
  			}},
        {data: 'front_page', name: 'front_page'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });
  	//edit 
	$('body').on('click', '.edit', function(){
	    let id = $(this).data('id');
	    $.get("brand/edit/"+id, function(data){
	      $('#modal_body').html(data);
	    });
	  });
</script>
@endsection