<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fa-solid fa-pen-nib"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Scholar's Source</div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
  <a class="nav-link" href="">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.products.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Product</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{route('supplier.index')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Supplier</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="stocks">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Stock</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="user">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>User Account</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('reviews.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Reviews</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="transaction">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Transaction History</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>