
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{--<a href="index3.html" class="brand-link">--}}
        {{--<img src="{{asset('admin/dist')}}/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
             {{--style="opacity: .8">--}}
        {{--<span class="brand-text font-weight-light">Dsahboard</span>--}}
    {{--</a>--}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('profile/picture/'.Auth::user()->pro_pic) }}" alt="Profile Picture"/>

            </div>
            <div class="info">
                <a class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        {{--<i class="nav-icon fas fa-tachometer-alt"></i>--}}
                        Bookings
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.users.index') }}" class="nav-link ">
                        {{--<i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.reviews') }}" class="nav-link ">
                        {{--<i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Reviews
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.reports') }}" class="nav-link ">
                        {{--<i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Reports
                        </p>
                    </a>
                </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>