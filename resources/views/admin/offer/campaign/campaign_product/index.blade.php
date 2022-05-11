@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Campaign Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          	<ol class="breadcrumb float-sm-right">
          		<a href="{{ route('campaign.product.list', $campaign_id) }}" class="btn btn-primary btn-sm">Product List <i class="fas fa-arrow-right"></i></a>
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
                <h3 class="card-title">All Campaign Product</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Brnad</th>
                    <th>Category</th>
                    <th>SubCat</th>
                    <th>Price({{ $setting->currency }})</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($product as $key=>$row)
                    @php
                    	$exists = DB::table('campaign_product')->where('campaign_id', $campaign_id)->where('product_id', $row->id)->first();
                    @endphp
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" height="32" width="32" alt="{{ $row->name }}"></td>
                      <td>{{ $row->brand_name }}</td>
                      <td>{{ $row->category_name }}</td>
                      <td>{{ $row->subcat_name }}</td>
                      <td>{{ $row->selling_price }}{{ $setting->currency }}</td>
                      <td>
                      	@if($exists)
                        	<button disabled class="btn btn-success btn-sm"><i class="fas fa-plus"> Disable</i></button>
                        @else
                        	<a href="{{ route('campaign.product.store', [$row->id, $campaign_id])}}" class="btn btn-success btn-sm"><i class="fas fa-plus"> Add</i></a>
                        @endif
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
@endsection