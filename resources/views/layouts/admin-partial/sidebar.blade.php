@php
  $data = DB::table('settings')->first();
  $alt = DB::table('seos')->first();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ url($data->favicon) }}" alt="{{ $alt->meta_title }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->avatar)
            <img class="img-circle elevation-2" style="border-radius: 100%; border: 1px solid seagreen" src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
            @else
              <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652__340.png" class="img-circle elevation-2" style="border-radius: 100%; border: 1px solid seagreen" alt="{{ Auth::user()->name }}">
          @endif
          
        </div>
        <div class="info">
          <a href="{{ url('/') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link {{ Route::is('admin.home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          {{-- category menu --}}
          @if(Auth::user()->category == 1)
          <li class="nav-item {{ Route::is('category.index') || Route::is('subcategory.index') || Route::is('childcategory.index') || Route::is('brand.index') || Route::is('warehouse.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link {{ Route::is('category.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subcategory.index') }}" class="nav-link {{ Route::is('subcategory.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('childcategory.index') }}" class="nav-link {{ Route::is('childcategory.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Child Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('brand.index') }}" class="nav-link {{ Route::is('brand.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouse.index') }}" class="nav-link {{ Route::is('warehouse.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Warehouse</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- product menu --}}
          @if(Auth::user()->product == 1)
          <li class="nav-item {{ Route::is('product.create') || Route::is ('product.index') || Route::is ('product.edit') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Product Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.create') }}" class="nav-link {{ Route::is('product.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{ Route::is('product.index') || Route::is ('product.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Product</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- orders menu --}}
          @if(Auth::user()->order == 1)
          <li class="nav-item {{ Route::is('admin.orders.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Orders Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ Route::is('admin.orders.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- offer menu --}}
          @if(Auth::user()->offer == 1)
          <li class="nav-item {{ Route::is('cupon.index') || Route::is('campaign.index') || Route::is('campaign.product')|| Route::is('campaign.product.list') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-angry"></i>
              <p>
                Offer Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('cupon.index') }}" class="nav-link {{ Route::is('cupon.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('campaign.index') }}" class="nav-link {{ Route::is('campaign.index') || Route::is('campaign.product')|| Route::is('campaign.product.list') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Campaign</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- pickup point menu --}}
          @if(Auth::user()->pickup == 1)
          <li class="nav-item {{ Route::is('pickuppoint.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-truck-pickup"></i>
              <p>
                Pickup Point
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pickuppoint.index') }}" class="nav-link {{ Route::is('pickuppoint.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pickup Point</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- tricket menu --}}
          @if(Auth::user()->tricket == 1)
          <li class="nav-item {{ Route::is('tricket.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Tricket Option
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('tricket.index') }}" class="nav-link {{ Route::is('tricket.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tricket</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- Setting menu --}}
          @if(Auth::user()->setting == 1)
          <li class="nav-item {{ Route::is('seo.setting') || Route::is('smtp.setting') || Route::is('page.index') || Route::is('page.index') || Route::is('website.setting') || Route::is('payment.getway') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting Options
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('seo.setting') }}" class="nav-link {{ Route::is('seo.setting') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seo Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('smtp.setting') }}" class="nav-link {{ Route::is('smtp.setting') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Smtp Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('payment.getway') }}" class="nav-link {{ Route::is('payment.getway') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('page.index') }}" class="nav-link {{ Route::is('page.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page Create</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.setting') }}" class="nav-link {{ Route::is('website.setting') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website Setting</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- blog menu --}}
          @if(Auth::user()->blog == 1)
          <li class="nav-item {{ Route::is('blog.category.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-blog"></i>
              <p>
                Blogs Option
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('blog.category.index') }}" class="nav-link {{ Route::is('blog.category.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{-- {{ route('blog.post.index') }} --}}" class="nav-link {{-- {{ Route::is('blog.post.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Post</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- contact menu --}}
          @if(Auth::user()->contact == 1)
          <li class="nav-item {{-- {{ Route::is('blog.category.index') ? 'menu-is-opening menu-open' : '' }} --}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Contact Option
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link {{-- {{ Route::is('blog.category.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Us</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- reports menu --}}
          @if(Auth::user()->report == 1)
          <li class="nav-item {{ Route::is('order.report.index') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-flag"></i>
              <p>
                Reports Option
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('order.report.index') }}" class="nav-link {{ Route::is('order.report.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{-- {{ route('blog.post.index') }} --}}" class="nav-link {{-- {{ Route::is('blog.post.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Report</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{-- {{ route('blog.post.index') }} --}}" class="nav-link {{-- {{ Route::is('blog.post.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{-- {{ route('blog.post.index') }} --}}" class="nav-link {{-- {{ Route::is('blog.post.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Report</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{-- {{ route('blog.post.index') }} --}}" class="nav-link {{-- {{ Route::is('blog.post.index') ? 'active' : '' }} --}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tricket Report</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- user role menu --}}
          @if(Auth::user()->role == 1)
          <li class="nav-item {{ Route::is('userRole.create') || Route::is('manage.role') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Role
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('userRole.create') }}" class="nav-link {{ Route::is('userRole.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('manage.role') }}" class="nav-link {{ Route::is('manage.role') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Manage</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- admin password change --}}
          <li class="nav-header">Profile</li>
          <li class="nav-item">
            <a href="{{ route('admin.password.change') }}" id="password" class="nav-link {{ Route::is('admin.password.change') ? 'active' : '' }}">
              <i class="nav-icon fas fa-key text-info"></i>
              <p class="text">Password Change</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.logout') }}" id="logout" class="nav-link {{ Route::is('admin.logout') ? 'active' : '' }}">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="text">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>