@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add User Role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('role.store') }}" method="post" id="user_role_form">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Role</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="name">Employe Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" id="name"  required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="email">Employe Email <span class="text-danger">*</span> </label>
                      <input type="email" class="form-control"  name="email" id="email" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="password">Password <span class="text-danger">*</span> </label>
                      <input type="password" class="form-control"  name="password" id="password" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Category</label>
                      <input type="checkbox" name="category" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Product</label>
                      <input type="checkbox" name="product" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Order</label>
                      <input type="checkbox" name="order" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Offer</label>
                      <input type="checkbox" name="offer" value="1">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Pickup</label>
                      <input type="checkbox" name="pickup" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Tricket</label>
                      <input type="checkbox" name="tricket" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Setting</label>
                      <input type="checkbox" name="setting" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Blog</label>
                      <input type="checkbox" name="blog" value="1">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Contact</label>
                      <input type="checkbox" name="contact" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Report</label>
                      <input type="checkbox" name="report" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Role</label>
                      <input type="checkbox" name="role" value="1">
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Status</label>
                      <input type="checkbox" name="status" value="1" checked>
                      (<small>if check user role active</small>)
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
            <!-- /.card -->
          <!-- right column -->
           <button class="btn btn-info ml-2" type="submit" id="submit"><span class="d-none loader">...Loading...</span><span class="btn_submit">Submit</span></button>
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
     //userrole insert method
    $('#user_role_form').submit(function(e){
    e.preventDefault();
    $('.loader').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#user_role_form')[0].reset();
        $('.loader').addClass('d-none');
      }
    });
  });
</script>
@endsection