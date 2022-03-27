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
              <li class="breadcrumb-item active">Website Setting</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="mx-auto col-md-10">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="text-center" style="font-size: 1.1rem;">Website Setting</h3>
              </div>
              <form class="form-horizontal" action="{{ route('website.setting.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body row g-3">
                  	<div class="form-group col-md-6">
	                  <label for="meta_author">Currency</label>
	                  <select class="form-control" name="currency">
                       <option value="৳" {{ ($data->currency == '৳') ? "selected" : "" }}>Taka</option> 
                       <option value="$" {{ ($data->currency == '$') ? "selected" : "" }}>USD</option> 
                    </select>
                	</div>
                	<div class="form-group col-md-6">
	                  <label for="phone_one">Phone One</label>
	                  <input type="number" class="form-control" name="phone_one" id="phone_one" placeholder="Phone Number One" value="{{ $data->phone_one }}">
                	</div>
                	<div class="form-group col-md-6">
	                  <label for="phone_two">Phone Two</label>
	                  <input type="number" class="form-control" name="phone_two" id="phone_two" placeholder="Phone Number Two" value="{{ $data->phone_two }}" />
                	</div>
                  <div class="form-group col-md-6">
                    <label for="main_mail">Main Email</label>
                    <input type="email" class="form-control" name="main_mail" id="main_mail" placeholder="Main Email" value="{{ $data->main_mail }}">
                  </div>
                	<div class="form-group col-md-6">
                    <label for="support_mail">Support Email</label>
                    <input type="email" class="form-control" name="support_mail" id="support_mail" placeholder="Support Email" value="{{ $data->support_mail }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $data->facebook }}" required />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="linkedin">Likedin</label>
                    <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ $data->linkedin }}" required />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" name="pinterest" id="pinterest" value="{{ $data->pinterest }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="messenger">Messenger</label>
                    <input type="text" class="form-control" name="messenger" id="messenger" value="{{ $data->messenger }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="instagram" value="{{ $data->instagram }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ $data->whatsapp }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" name="youtube" id="youtube" value="{{ $data->youtube }}" required />
                </div>
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Write Shop Address">{{ $data->address }}</textarea>
                </div>
                <div class="form-group col-md-6">
                      <label for="logo">Logo</label>
                      <input type="file" class="form-control" data-height="140" id="logo" name="logo" aria-describedby="logo" onchange="document.getElementById('logo_id').src = window.URL.createObjectURL(this.files[0])">
                      <input type="hidden" name="old_logo" value="{{ $data->logo }}">
                      <small id="logo" class="form-text text-muted">This is Website Logo</small>
                      <div style="width:'100%'; height: '300px'; overflow: hidden; text-align: center; ">
                        <img id="logo_id" src="{{ url($data->logo) }}" width="100px" height="100px" />
                      </div>
                </div>
                 <div class="form-group col-md-6">
                      <label for="favicon">FavIcon</label>
                      <input type="file" class="form-control" data-height="140" id="favicon" name="favicon" aria-describedby="favicon" onchange="document.getElementById('favicon_id').src = window.URL.createObjectURL(this.files[0])">
                      <input type="hidden" name="old_favicon" value="{{ $data->favicon }}">
                      <small id="favicon" class="form-text text-muted">This is favicon</small>
                      <div style="width:'100%'; height: '300px'; overflow: hidden; text-align: center; ">
                        <img id="favicon_id" src="{{ url($data->favicon) }}" width="100px" height="100px" />
                      </div>
                </div>
                </div>
                <div class="card-footer mx-auto text-center">
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
                </div>
              </form>
            </div>
        </div>
          </div>
      </div>
    </section>
  </div>
@endsection
