<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('ci-admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::segment(2) == 'home'? '': 'active' }}">
        <a class="nav-link" href="{{ url('ci-admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item" {{ Request::segment(2) == 'gallery'? 'active': '' }}>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-images"></i>
            <span>Galleries</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('ci-admin/gallery/1') }}">Početna</a>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('ci-admin/gallery/2') }}">Šivenje po meri</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item" {{ Request::segment(2) == 'sliders'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/sliders') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-images"></i>
                    </span>
            <span class="text">Sliders</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        gs-kutija
    </div>

    <li class="nav-item" {{ Request::segment(2) == 'categories'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/categories/1') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Categories</span>
                </a>
    </li>

    <li class="nav-item" {{ Request::segment(2) == 'products'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/products/1') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-shopping-bag"></i>
                    </span>
                    <span class="text">Products</span>
                </a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Shop
    </div>

    <li class="nav-item" {{ Request::segment(2) == 'categories'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/categories/2') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-arrow-right"></i>
                    </span>
            <span class="text">Categories</span>
        </a>
    </li>

    <li class="nav-item" {{ Request::segment(2) == 'products'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/products/2') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-shopping-bag"></i>
                    </span>
            <span class="text">Products</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item" {{ Request::segment(2) == 'orders'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/orders') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-shopping-cart"></i>
                    </span>
            <span class="text">Orders</span>
        </a>
    </li>
     <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item" {{ Request::segment(2) == 'users'? 'active': '' }}>
        <a class="nav-link" href="{{ url('ci-admin/users') }}">
          <span class="icon text-gray-600">
                      <i class="fas fa-users"></i>
                    </span>
            <span class="text">Users</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->