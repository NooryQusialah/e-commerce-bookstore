<!-- Sidebar -->
<ul class="pr-0 navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
{{--            <img style="width:70%" src="{{ asset('logo.png') }}">--}}
            <p>مكتبة زاد </p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>لوحة التحكم</span></a>
    </li>
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('admin/dashboard/books*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.books.index')}}">
            <i class="fas fa-book-open"></i>
            <span>الكتب</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->is('admin/dashboard/categories*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.categories.index')}}">
            <i class="fas fa-folder"></i>
            <span>التصنيفات</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/authors*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.authors.index')}}">
            <i class="fas fa-pen-fancy"></i>
            <span>المؤلفون</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('admin/dashboard/publishers*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.publishers.index')}}">
            <i class="fas fa-table"></i>
            <span>الناشرون</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ request()->is('admin/dashboard/users*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('admin.users.index')}}">
            <i class="fas fa-users"></i>
            <span>المستخدمون</span></a>
    </li>

    <li class="nav-item {{ request()->is('admin/allproduct*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{route('allProducts')}}">
            <i class="fas fa-shopping-bag"></i>
            <span>المشتريات</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
