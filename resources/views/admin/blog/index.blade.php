@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Category</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('blog.category.store') }}" method="POST" id="blog_add_form">
                      @csrf
                    <div class="modal-body">
	                    <div class="form-group">
	                      <label for="blog_categoy_name">Category Name</label>
	                      <input type="text" class="form-control" id="blog_categoy_name" name="blog_categoy_name" aria-describedby="cat" placeholder="Enter Category Name" required>
	                      <small id="cat" class="form-text text-muted">This is Blog Category</small>
	                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
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
                <h3 class="card-title">All Category</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table class="table table-bordered table-striped table-sm ytable">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body"></div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(function childCategory(){
  	 	table = $('.ytable').DataTable({
  		processing: true,
  		serverSide: true,
  		ajax:"{{ route('blog.category.index') }}",
  		columns: [
  			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
  			{data: 'blog_categoy_name', name: 'blog_categoy_name'},
  			{data: 'slug', name: 'slug'},
  			{data: 'action', name: 'action', oderable: true, searchable: true},
  		]
  	});
  });

   $('#blog_add_form').submit(function(e){
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
        $('#blog_add_form')[0].reset();
        $('#insertModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
	//edit modal
  $('body').on('click', '.edit', function(){
    let cat_id = $(this).data('id');
    $.get("blog/edit/"+cat_id, function(data){
      $('#modal_body').html(data);
    });
  });
  // blog category delete with ajax
$(document).ready(function(){
  $(document).on('click', '#delete_blog_category',function(e){
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