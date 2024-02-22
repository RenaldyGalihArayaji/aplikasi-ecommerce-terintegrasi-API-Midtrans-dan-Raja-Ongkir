<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2" href="{{ route('dashboard')}}">
      <div class="sidebar-brand-icon ">
        <img src="{{ asset('admin/img/bg.png')}}" alt="" width="155">
      </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::path() == 'dashboard'? 'active' : ''}}">
      <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::path() == 'slider'? 'active' : ''}}">
        <a class="nav-link" href="{{ route('slider.index')}}">
          <i class="fa-regular fa-images"></i>
          <span>Sliders</span></a>
    </li>
  
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::path() == 'pengguna'? 'active' : ''}}">
        <a class="nav-link" href="{{ route('pengguna.index')}}">
          <i class="fa-regular fa-user"></i>
          <span>Users</span></a>
     </li>
  
      <!-- Divider -->
    <hr class="sidebar-divider ">

    <!-- Heading -->
    <div class="sidebar-heading">
        Components
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Product Management</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Product Management:</h6>
          <a class="collapse-item {{ Request::path() == 'category'? 'active' : ''}}" href="{{ route('category.index')}}">Category</a>
          <a class="collapse-item  {{ Request::path() == 'product'? 'active' : ''}}" href="{{ route('product.index')}}">Product</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
     <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::path() == 'order'? 'active' : ''}}">
      <a class="nav-link" href="{{ route('order.index')}}">
        <i class="fa-solid fa-paper-plane "></i>
        <span>Orders</span>
      </a>
    </li>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ Request::path() == 'shipping-address'? 'active' : ''}}">
      <a class="nav-link" href="{{ route('shipping-address.index')}}">
        <i class="fa-solid fa-building-columns"></i>
        <span>Shipping Address</span></a>
    </li>
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report" aria-expanded="true" aria-controls="report">
        <i class="fas fa-fw fa-cog"></i>
        <span>Report</span>
      </a>
      <div id="report" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Report:</h6>
          <a class="collapse-item {{ Request::path() == 'report-sales'? 'active' : ''}}" href="{{ route('sales')}}">Sales</a>
          <a class="collapse-item  {{ Request::path() == 'report-finance'? 'active' : ''}}" href="{{ route('finance')}}">Finance</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider my-0">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>