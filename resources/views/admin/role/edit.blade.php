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
              <li class="breadcrumb-item active">Update User Role</li>
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
       <form action="{{ route('role.update') }}" method="post">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Role</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<input type="hidden" name="id" value="{{ $data->id }}">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="name">Employe Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="email">Employe Email <span class="text-danger">*</span> </label>
                      <input type="email" class="form-control"  name="email" id="email" value="{{ $data->email }}" required="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Category</label>
                      <input type="checkbox" name="category" value="1" @if($data->category == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Product</label>
                      <input type="checkbox" name="product" value="1" @if($data->product == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Order</label>
                      <input type="checkbox" name="order" value="1" @if($data->order == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Offer</label>
                      <input type="checkbox" name="offer" value="1" @if($data->offer == 1) checked @endif>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Pickup</label>
                      <input type="checkbox" name="pickup" value="1" @if($data->pickup == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Tricket</label>
                      <input type="checkbox" name="tricket" value="1" @if($data->tricket == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Setting</label>
                      <input type="checkbox" name="setting" value="1" @if($data->setting == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Blog</label>
                      <input type="checkbox" name="blog" value="1" @if($data->blog == 1) checked @endif>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label>Contact</label>
                      <input type="checkbox" name="contact" value="1" @if($data->contact == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Report</label>
                      <input type="checkbox" name="report" value="1" @if($data->report == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Role</label>
                      <input type="checkbox" name="role" value="1" @if($data->role == 1) checked @endif>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>Status</label>
                      <input type="checkbox" name="status" value="1" @if($data->status == 1) checked @endif>
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
           <button class="btn btn-info ml-2" type="submit" id="submit">Update</span></button>
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
  </script> --}}
@endsection