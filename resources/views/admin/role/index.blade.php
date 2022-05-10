@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary btn-sm">
              	<a href="{{ route('userRole.create') }}" class="text-white">
              		+ Add New
              	</a>
              </button>
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
                <h3 class="card-title">All User</h3>
              </div>
              <!-- /.card-header -->
               <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key=>$row)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td>{{ $row->email }}</td>
                      <td>
                      	@if($row->category == "1")<span class="badge badge-success">Category</span>@endif
                      	@if($row->product == "1")<span class="badge badge-success">Prodcut</span>@endif
                      	@if($row->order == "1")<span class="badge badge-success">Order</span>@endif
                      	@if($row->offer == "1")<span class="badge badge-success">Offer</span>@endif
                      	@if($row->pickup == "1")<span class="badge badge-success">Pickup</span>@endif
                      	@if($row->tricket == "1")<span class="badge badge-success">Tricket</span>@endif
                      	@if($row->setting == "1")<span class="badge badge-success">Setting</span>@endif
                      	@if($row->blog == "1")<span class="badge badge-success">Blog</span>@endif
                      	@if($row->contact == "1")<span class="badge badge-success">Contact</span>@endif
                      	@if($row->report == "1")<span class="badge badge-success">Report</span>@endif
                      	@if($row->role == "1")<span class="badge badge-success">Role</span>@endif
                      </td>
                      <td>
                      	@if($row->status == "1")
                           <span class="badge badge-success">Active</span>
                           @else
                           <span class="badge badge-danger">Inactive</span>
                         @endif
                      </td>
                      <td>
                        <a href="{{ route('role.edit', $row->id) }}" class="btn btn-info btn-sm" ><i class="fas fa-edit"></i></a>
                        <a href="{{ route('role.delete', $row->id) }}" id="category-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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