<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $userGlobal->name }}<p>
                        <small>{{ $userGlobal->email }}</small>
                    </p></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
                <li class="nav-item">
                    {{-- <a href="{{ url('home') }}" class="nav-link {{ set_active('home') }}"> --}}
                    <a href="{{ url('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>

                <li class="nav-header">Management</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Settings <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @canany(['create-role', 'edit-role', 'delete-role'])
                            <li class="nav-item">
                                {{-- <a href="{{ url('roles') }}" class="nav-link {{ set_active('roles') }}"> --}}
                                <a href="{{ url('roles') }}"
                                    class="nav-link {{ request()->is('roles/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Management Roles</p>
                                </a>
                            </li>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <li class="nav-item">
                                {{-- modif lte- active route --}}
                                {{-- <a href="{{ url('users') }}" class="nav-link {{ set_active('users.*') }}"> --}}
                                <a href="{{ url('users') }}"
                                    class="nav-link {{ request()->is('users/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Management Users</p>
                                </a>
                            </li>
                        @endcanany
                        @canany(['create-product', 'edit-product', 'delete-product'])
                            <li class="nav-item">
                                {{-- modif lte- active route --}}
                                {{-- <a href="{{ url('users') }}" class="nav-link {{ set_active('users.*') }}"> --}}
                                <a href="{{ url('products') }}"
                                    class="nav-link {{ request()->is('products/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Products</p>
                                </a>
                            </li>
                        @endcanany
                        @canany(['create-mahasiswa', 'edit-mahasiswa', 'delete-mahasiswa', 'show-mahasiswa'])
                            <li class="nav-item">
                                {{-- modif lte- active route --}}
                                {{-- <a href="{{ url('users') }}" class="nav-link {{ set_active('users.*') }}"> --}}
                                <a href="{{ url('mahasiswas') }}"
                                    class="nav-link {{ request()->is('mahasiswas/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Mahasiswas</p>
                                </a>
                            </li>
                        @endcanany
                        @canany(['create-permission', 'edit-permission', 'delete-permission', 'show-permission'])
                            <li class="nav-item">
                                {{-- <a href="{{ url('home') }}" class="nav-link {{ set_active('home') }}"> --}}
                                <a href="{{ url('crud-permission') }}"
                                    class="nav-link {{ request()->is('crud-permission') || request()->is('permissions/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Permissions</p>
                                </a>
                            </li>
                        @endcanany
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="nav-header">Exit</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>
                            {{ __('Logout') }}
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
