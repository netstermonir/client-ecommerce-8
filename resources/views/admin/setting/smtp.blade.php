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
              <li class="breadcrumb-item active">Smtp Setting</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="mx-auto col-10 col-md-10">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="text-center" style="font-size: 1.1rem;">Smtp Mail Setting</h3>
              </div>
              <form class="form-horizontal" action="{{ route('smtp.setting.update', $data->id) }}" method="POST">
                @csrf
                <div class="card-body">
                  	<div class="form-group">
	                  <label for="mailer">Mailer</label>
	                  <input type="text" class="form-control" name="mailer" id="mailer" placeholder="Mailer" value="{{ $data->mailer }}">
                	</div>
                	<div class="form-group">
	                  <label for="host">Host</label>
	                  <input type="text" class="form-control" name="host" id="host" placeholder="Host" value="{{ $data->host }}">
                	</div>
                	<div class="form-group">
	                  <label for="port">Port</label>
	                  <input type="text" class="form-control" name="port" id="port" placeholder="Port" value="{{ $data->port }}">
                	</div>
                	<div class="form-group">
	                  <label for="user_name">User Name</label>
	                  <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="{{ $data->user_name }}">
                	</div>
                	<div class="form-group">
	                  <label for="password">Password</label>
	                  <input type="password" class="form-control" name="password" id="password" placeholder="password" value="{{ $data->password }}">
                	</div>
                </div>
                <div class="card-footer mx-auto text-center">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
            </div>
        </div>
          </div>
      </div>
    </section>
  </div>
@endsection
