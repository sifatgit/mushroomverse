<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mushroomverse|Admin_Panel</title>

@include('backend.partials.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>



     @php $noti = App\Models\Notification::where('seen',0)->latest()->first(); @endphp
     @if($noti)
     @php $last_id = $noti->id; @endphp
     <input id="last_notifications_id" type="hidden" name="last_id" value="{{$last_id}}">
     @else
     @php $last_id = 0; @endphp
     <input id="last_notifications_id" type="hidden" name="last_id" value="{{$last_id}}">
     @endif
     @php $count_data = count(App\Models\Notification::where('seen',0)->get()) @endphp      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span id="count" class="badge badge-warning navbar-badge">{{$count_data}}</span>
        </a>
        <div id="notifications" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          
          <div class="dropdown-divider"></div>
          @foreach(App\Models\Notification::where('seen',0)->get() as $notification)
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{$notification->message}}
            <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
          </a>
          
          
          <div class="dropdown-divider"></div>
          @endforeach

          <div class="dropdown-divider"></div>
          @php $noti = App\Models\Notification::where('seen', 0)->get(); @endphp
          @if($noti->isNotEmpty())
          <a href="{{route('admin.notifications')}}" class="dropdown-item dropdown-footer">See All Notifications @else <a href="#" class="dropdown-item dropdown-footer"> No notifications @endif</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('public/admin_asset/dist/img/Mushroomverse_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Mushroomverse</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/admin_asset/dist/img/blank_profile.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('/admin')}}" class="nav-link">
              <i class="nav-icon fas fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sliders"></i>
              <p>
                Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin.sliders" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Sliders</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-layer-group"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/categories')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Categories</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Brand
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.brands')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Brands</p>
                </a>
              </li>
            </ul>
          </li>          


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.product.add')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{route('admin.products')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin.stocks" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.product.weights')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Weights</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.product.units')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Units</p>
                </a>
              </li>                            
            </ul>
          </li>

            <li class="nav-item">
            <a href="{{route('admin.orders')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Divisions/District
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.divisions')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Divisions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.districts')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Districts</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.sliders')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Sliders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.settings')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.blogs')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Blogs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="{{route('admin.notifications')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Notifications
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.messages')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-message"></i>
              <p>
                Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>               

          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <a href="{{route('logout')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <button class="text-light" style="background-color: #343A40;" type="submit">Logout</button>
               </form>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('content')
      @php
      $latest_messages = App\Models\Message::where('seen', 0)->get();
      $last_message_id = App\Models\Message::where('seen', 0)->orderBy('id', 'asc')->pluck('id')->last();

      @endphp

      <input type="hidden" name="last_message_id" id="last_message_id" value="{{ $last_message_id ?? 0 }}">
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('backend.partials.scripts')
</body>
</html>
