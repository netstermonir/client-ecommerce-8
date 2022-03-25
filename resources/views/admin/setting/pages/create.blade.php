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
              <li class="breadcrumb-item active">Website Page Create</li>
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
                <h3 class="text-center" style="font-size: 1.1rem;">Page Create Form</h3>
              </div>
              <form class="form-horizontal" action="{{ route('page.store') }}" method="POST">
                @csrf
                <div class="card-body">
                	<div class="form-group">
	                  <label for="position">Page Position</label>
	                  <select class="form-control" name="page_position" id="position">
	                  	<option value="1">Line One</option>
	                  	<option value="2">Line Two</option>
	                  </select>
                	</div>
                  	<div class="form-group">
	                  <label for="page_name">Page Name</label>
	                  <input type="text" class="form-control" name="page_name" id="page_name" placeholder="Page Name">
                	</div>
                	<div class="form-group">
	                  <label for="title">Page Title</label>
	                  <input type="text" class="form-control" name="page_title" id="title" placeholder="Page Title">
                	</div>
                	<div class="form-group">
	                  <label for="summernote">Page Description</label>
	                 <textarea class="form-control" name="page_description" id="summernote"></textarea>
	                 <small>The Text show will webpage</small>
                	</div>
                </div>
                <div class="card-footer mx-auto text-center">
                  <button type="submit" class="btn btn-success">Create Page</button>
                </div>
              </form>
            </div>
        </div>
          </div>
      </div>
    </section>
  </div>
@endsection
