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
              <li class="breadcrumb-item active">Seo Setting</li>
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
                <h3 class="text-center" style="font-size: 1.1rem;">One Page Seo Setting</h3>
              </div>
              <form class="form-horizontal" action="{{ route('seo.setting.update', $data->id) }}" method="POST">
                @csrf
                <div class="card-body">
                  	<div class="form-group">
	                  <label for="meta_author">Meta Author</label>
	                  <input type="text" class="form-control" name="meta_author" id="meta_author" placeholder="Meta Author" value="{{ $data->meta_author }}">
                	</div>
                	<div class="form-group">
	                  <label for="meta_tag">Meta Tag</label>
	                  <input type="text" class="demo-default selectized" name="meta_tag" id="meta_tag" placeholder="Meta Author" value="{{ $data->meta_tag }}">
	                  <small>Example: ecommerce, online_shopping</small>
                	</div>
                	<div class="form-group">
	                  <label for="meta_title">Meta Title</label>
	                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Author" value="{{ $data->meta_title }}">
                	</div>
                	<div class="form-group">
	                  <label for="meta_description">Meta Description</label>
	                  <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description Here Write">{{ $data->meta_description }}</textarea>
                	</div>
                	<div class="form-group">
	                  <label for="meta_keyword">Meta Keyword</label>
	                  <input type="text" class="demo-default selectized" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword" value="{{ $data->meta_keyword }}">
	                  <small>Example: ecommerce, online_shopping</small>
                	</div>
                	<div class="form-group">
	                  <label for="google_verification">Google Verification Code</label>
	                  <input type="text" class="form-control" name="google_verification" id="google_verification" placeholder="Google Verification Code" value="{{ $data->google_verification }}">
                	</div>
                	<div class="form-group">
	                  <label for="google_analytics">Google Analytics Code</label>
	                  <input type="text" class="form-control" name="google_analytics" id="google_analytics" placeholder="Google Analytics Code" value="{{ $data->google_analytics }}">
                	</div>
                	<div class="form-group">
	                  <label for="alexa_verification">Alexa Verification Code</label>
	                  <input type="text" class="form-control" name="alexa_verification" id="alexa_verification" placeholder="Alexa Verification Code" value="{{ $data->alexa_verification }}">
                	</div>
                	<div class="form-group">
	                  <label for="google_adsence">Google Adsence Code</label>
	                  <textarea class="form-control" name="google_adsence" id="google_adsence" placeholder="Google Adsence Code">{{ $data->google_adsence }}</textarea>
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
