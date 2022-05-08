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
              <li class="breadcrumb-item active">Payment Getway Setting</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          	<div class="mx-auto col-md-4">
	            <div class="card card-success">
	              <div class="card-header">
	                <h3 class="text-center" style="font-size: 1.1rem;">Aamarpay Payment Getway Setting</h3>
	              </div>
	              <form class="form-horizontal" action="{{ route('aamarpay.update', $aamarpay->id) }}" method="POST">
	                @csrf
	                <div class="card-body">
	                	{{-- <input type="hidden" name="id" value="{{ $aamarpay->id }}"> --}}
	                  	<div class="form-group">
		                  <label for="store_id">Store Id<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="store_id" id="store_id" value="{{ $aamarpay->store_id }}">
	                	</div>
	                	<div class="form-group">
		                  <label for="signature_key">Signature Key<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="signature_key" id="signature_key" value="{{ $aamarpay->signature_key }}">
	                	</div>
	                	<div class="form-group">
		                  <label>Pay Live</label>
		                  <input type="checkbox" name="status" value="1" @if($aamarpay->status == 1) checked @endif>
		                  <small>(if not check so it is work only sandbox)</small>
	                	</div>
	                </div>
	                <div class="card-footer mx-auto text-center">
	                  <button type="submit" class="btn btn-success">Save</button>
	                </div>
	              </form>
	            </div>
        	</div>
        	<div class="mx-auto col-md-4">
	            <div class="card card-success">
	              <div class="card-header">
	                <h3 class="text-center" style="font-size: 1.1rem;">SurjoPay Payment Getway Setting</h3>
	              </div>
	              <form class="form-horizontal" action="{{-- {{ route('smtp.setting.update', $data->id) }} --}}" method="POST">
	                @csrf
	                <div class="card-body">
	                  	<div class="form-group">
		                  <label for="store_id">Store Id<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="store_id" id="store_id" value="{{ $surjopay->store_id }}">
	                	</div>
	                	<div class="form-group">
		                  <label for="signature_key">Signature Key<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="signature_key" id="signature_key"value="{{ $surjopay->signature_key }}">
	                	</div>
	                	<div class="form-group">
		                  <label>Pay Live</label>
		                  <input type="checkbox" name="status" value="1" @if($surjopay->status == 1) checked @endif>
		                  <small>(if not check so it is work only sandbox)</small>
	                	</div>
	                </div>
	                <div class="card-footer mx-auto text-center">
	                  <button type="submit" class="btn btn-success">Save</button>
	                </div>
	              </form>
	            </div>
        	</div>
        	<div class="mx-auto col-md-4">
	            <div class="card card-success">
	              <div class="card-header">
	                <h3 class="text-center" style="font-size: 1.1rem;">SSLCommerz Payment Getway Setting</h3>
	              </div>
	              <form class="form-horizontal" action="{{-- {{ route('smtp.setting.update', $data->id) }} --}}" method="POST">
	                @csrf
	                <div class="card-body">
	                  	<div class="form-group">
		                  <label for="store_id">Store Id<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="store_id" id="store_id" value="{{ $sslpay->store_id }}">
	                	</div>
	                	<div class="form-group">
		                  <label for="signature_key">Signature Key<span class="text-danger">*</span></label>
		                  <input type="text" class="form-control" name="signature_key" id="signature_key" value="{{ $sslpay->signature_key }}">
	                	</div>
	                	<div class="form-group">
		                  <label>Pay Live</label>
		                  <input type="checkbox" name="status" value="1" @if($sslpay->status == 1) checked @endif>
		                  <small>(if not check so it is work only sandbox)</small>
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
