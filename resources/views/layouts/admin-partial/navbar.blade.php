@php
  $tricket = DB::table('trickets')->where('status', 0)->count();
  $newslatter = DB::table('newslatters')->count();
@endphp
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" title="Subscriber">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ $newslatter }}</span>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" title="Tricket">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ $tricket }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>