@php
  $data = DB::table('settings')->first();
  $alt = DB::table('seos')->first();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url($data->favicon) }}" alt="{{ $alt->meta_title }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Laravel 8</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652__340.png" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
          {{-- offer menu --}}
          <li class="nav-item {{ Route::is('seo.setting') || Route::is('smtp.setting') || Route::is('page.index') || Route::is('page.index') || Route::is('website.setting') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Offer
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
                <a href="{{ route('smtp.setting') }}" class="nav-link {{ Route::is('smtp.setting') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Campaign</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Setting menu --}}
          <li class="nav-item {{ Route::is('seo.setting') || Route::is('smtp.setting') || Route::is('page.index') || Route::is('page.index') || Route::is('website.setting') ? 'menu-is-opening menu-open' : '' }}">
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
                <a href="{{ route('page.index') }}" class="nav-link {{ Route::is('page.index') ? 'active' : '' }}">
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