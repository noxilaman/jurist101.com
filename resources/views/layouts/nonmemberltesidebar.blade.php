<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-0">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('jurist-logo.png') }}" alt="Jurist 101 | ค้นหากฎหมายง่ายๆ"
            class="brand-image img-circle elevation-1" style="opacity: .8">
        <span class="brand-text font-weight-light">JURIST 101</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- <li class="nav-header">Header</li> --}}
                <li class="nav-item">
                    <a href="/nonmember/search" class="nav-link{{ Route::currentRouteNamed('search') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-search text-info {{ (Route::currentRouteNamed('search') || Route::currentRouteNamed('advancesearch')) ? ' text-white' : '' }}"></i>
                        <p>ค้นหาหลัก</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link bookmarks{{ Route::currentRouteNamed('bookmarks') ? ' active' : '' }}">
                        <i class="fas fa-bookmark nav-icon text-info {{ Route::currentRouteNamed('bookmarks') ? ' text-white' : '' }}"></i>
                        <p>Bookmarks</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
