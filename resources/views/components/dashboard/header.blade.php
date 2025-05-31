<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="mr-4 lead"><b>@yield('heading')</b></div>

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav mr-auto">

        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
           <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle border" width="40" height="40">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in" style="right:-90px">
                <a class="dropdown-item" href="{{ route('profile.show') }}">
                    {{ __('الملف الشخصي') }}
                </a>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </a>
                @endif

                <a class="dropdown-item text-right" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    تسجيل خروج
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
