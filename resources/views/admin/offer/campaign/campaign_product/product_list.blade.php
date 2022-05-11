@extends('layouts.admin')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Campaign: {{ $campaign->name }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          	<ol class="breadcrumb float-sm-right">
          		
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
                <h3 class="card-title">All Campaign Product Exists</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Price({{ $setting->currency }})</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($product as $key=>$row)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" height="32" width="32" alt="{{ $row->name }}"></td>
                      <td>{{ $row->code }}</td>
                      <td>{{ $row->price }}{{ $setting->currency }}</td>
                      <td>
                    	<a href="{{ route('campaign.product.delete', $row->id) }}" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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