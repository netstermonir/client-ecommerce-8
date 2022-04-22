@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="cat" placeholder="Enter Category Name" required>
                      <small id="cat" class="form-text text-muted">This is Manin Category</small>
                    </div>
                    <div class="form-group">
                        <label for="category_name">Show on Homepage</label>
                       <select class="form-control" name="status">
                         <option value="1">Yes</option>
                         <option value="0">No</option>
                       </select>
                        <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>
                    </div> 
                    <div class="form-group">
                      <label for="category_name">Category Icon</label>
                      <input type="file" class="dropify" id="icon" name="icon" required="">
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
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Category Name</th>
                    <th>Category Icon</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key=>$row)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->category_name }}</td>
                      <td><img src="{{ asset($row->icon) }}" height="32" width="32"></td>
                      <td>@if($row->status == "1")
                           <span class="badge badge-success">Home Page</span>
                           @else
                           <span class="badge badge-danger">Not Home Page</span>
                         @endif</td>
                      <td>
                        <a href="#" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#categoryeditModal" data-id="{{ $row->id }}" ><i class="fas fa-edit"></i></a>
                        <a href="{{ route('category.delete', $row->id) }}" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                  </tr>
                  @endforeach
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
  <div class="modal-dialog modal-lg" role="document">
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
 <script type="text/javascript">
  $('.dropify').dropify();

</script>
<script type="text/javascript">
  $('body').on('click', '.edit', function(){
    let cat_id = $(this).data('id');
    $.get("category/edit/"+cat_id, function(data){
      $('#modal_body').html(data);
    });
  });
</script>
@endsection