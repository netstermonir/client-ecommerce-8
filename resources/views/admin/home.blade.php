@extends('layouts.admin')

@section('admin_content')

@php
  $customer = DB::table('users')->where('is_admin', NULL)->orderBy('id', 'DESC')->limit(8)->get();
  $most_view = DB::table('products')->orderBy('product_views', 'DESC')->where('status', 1)->limit(12)->get();
  $latest_order = DB::table("order_details")->leftJoin("orders","order_details.order_id","orders.id")->select("order_details.*", "orders.*")->orderBy('orders.id', 'DESC')->limit(8)->get();
  $product = DB::table('products')->get();
  $active_product = DB::table('products')->where('status', 1)->get();
  $inactive_product = DB::table('products')->where('status', 0)->get();
  $category = DB::table('categories')->count();
  $brand = DB::table('brands')->count();
  $warehouse = DB::table('warehouses')->count();
  $tricket = DB::table('trickets')->where('status', 0)->count();
  $cupon = DB::table('cupons')->count();
  $newslatter = DB::table('newslatters')->count();
  $pending_order = DB::table('orders')->where('status', 0)->count();
  $success_order = DB::table('orders')->where('status', 3)->count();
@endphp

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fab fa-product-hunt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Product</span>
                <span class="info-box-number">
                  {{ count($product) }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Product</span>
                <span class="info-box-number">{{ count($active_product) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Inactive Product</span>
                <span class="info-box-number">{{ count($inactive_product) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">{{ count($customer) }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Category</span>
                <span class="info-box-number">
                  {{ $category }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-peace"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Brand</span>
                <span class="info-box-number">{{ $brand }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-home"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Warehouse</span>
                <span class="info-box-number">{{ $warehouse }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ticket-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Tricket</span>
                <span class="info-box-number">{{ $tricket }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-angry"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Coupon</span>
                <span class="info-box-number">
                  {{ $cupon }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subscribers</span>
                <span class="info-box-number">{{ $newslatter }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Order</span>
                <span class="info-box-number">{{ $pending_order }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-bag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Complete Order</span>
                <span class="info-box-number">{{ $success_order }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- /.card -->
            <div class="row">
              <!-- /.col -->

              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Customer</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">{{ count($customer) }} New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach($customer as $row)
                      <li>
                        @if($row->avatar)
                        <img width="80%" style="border-radius: 100%; border: 1px solid seagreen" src="{{ asset($row->avatar) }}" alt="{{ $row->name }}">
                        @else
                          <img class="" width="80%" style="border-radius: 100%; border: 1px solid seagreen"  src="{{ asset('public/frontend') }}/images/avatar3.png" alt="{{ $row->name }}">
                        @endif
                        <h6 class="users-list-name">{{ $row->name }}</h6>
                        <span class="users-list-date">{{ date('d F Y', strtotime($row->created_at)) }}</span>
                      </li>
                      @endforeach
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a class="btn btn-sm btn-secondary" href="{{ route('manage.role') }}">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <span class="badge badge-danger">{{ count($latest_order) }} Latest Orders</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Item</th>
                      <th>Customer</th>
                      <th>Payment</th>
                      <th>Date</th>
                      <th>Total({{ $setting->currency }})</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($latest_order as $row)
                      <tr>
                        <td><a href="{{ route('admin.orders.index') }}">{{ $row->order_id }}</a></td>
                        <td>{{ substr($row->product_name, 0, 10)  }}..</td>
                        <td>{{ $row->c_name }}</td>
                        <td>{{ $row->payment_type }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->total }}{{ $setting->currency }}</td>
                        <td>
                          @if($row->status==0)
                                 <span class="badge badge-danger">Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info">Recieved</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary">Shipped</span>
                              @elseif($row->status==3)
                                 <span class="badge badge-success">Completed</span>
                              @elseif($row->status==4)
                                 <span class="badge badge-warning">Return</span>
                              @elseif($row->status==5)
                                 <span class="badge badge-danger">Cancel</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- /.info-box -->
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Most View Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach($most_view as $row)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <p class="product-title">
                        @isset($row->product_views)
                        <span class="badge badge-success float-right">
                          {{ $row->product_views }} Views
                        </span>
                        @endisset

                        @if($row->discount_price == Null)
                          <span class="badge badge-warning mr-2 float-right">{{ $setting->currency }}{{ $row->selling_price }}</span>
                            @else
                                <div class="product_price">
                                  <del class="text-danger" style="font-size:12px;">{{ $setting->currency }}{{ $row->selling_price }}</del>
                                  {{ $setting->currency }}{{ $row->discount_price }}
                                </div>
                        @endif
                      </p>
                      <span class="product-description">
                        {{ substr($row->name, 0, 15) }}..
                      </span>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a class="btn btn-sm btn-secondary" href="{{ route('product.index') }}" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
