<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center">
    
    <div class="logo">
       <img src="{{ asset('template/assets/img/logo/logo.png') }}"alt=""></div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
  <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
    <i class="fa-solid fa-chart-line"></i>
      <span>Dashboard</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.products.index') }}">
      <i class="fa-solid fa-tags"></i>  
      <span>Product</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{route('supplier.index')}}">
      <i class="fa-solid fa-users-rectangle"></i>
      <span>Supplier</span></a>
  </li>
  

  <li class="nav-item">
    <a class="nav-link" href="{{route('users.index')}}">
      <i class="fa-solid fa-user"></i>
      <span>User Account</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.orders.index') }}">
      <i class="fa-solid fa-shopping-cart"></i>
      <span>Orders</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{route('supplier_transaction.index')}}">
      <i class="fa-solid fa-clipboard"></i>
      <span>Transaction History</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{route('courier.index')}}">
      <i class="fa-solid fa-clipboard"></i>
      <span>Courier</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>