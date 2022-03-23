@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dasboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Password Change</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 mx-auto my-5">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="text-center" style="font-size: 1.1rem;">Change Admin Password</h3>
              </div>
              <form class="form-horizontal" action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="col-sm-10 mx-auto my-2">
                      <input type="password" class="form-control" name="old_pass" id="inputPassword2" placeholder="Old Password">
                    </div>
                </div>
                  <div class="form-group">
                    <div class="col-sm-10 mx-auto my-2">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword3" placeholder="New Password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-10 mx-auto my-2">
                      <input type="password" class="form-control" name="password_confirmation" id="inputPassword4" placeholder=" Confirm Password">
                    </div>
                  </div>
                </div>
                <div class="card-footer mx-auto text-center">
                  <button type="submit" class="btn btn-info">Update Password</button>
                </div>
              </form>
            </div>
        </div>
          </div>
      </div>
    </section>
  </div>
@endsection
