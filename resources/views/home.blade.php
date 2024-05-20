{{-- yang baru --}}
@extends('layouts.backend')

@section('title', 'Halaman Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">/ <a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}

                            <p>This is your application dashboard.</p>

                            @canany(['create-role', 'edit-role', 'delete-role'])
                            <a class="btn btn-primary" href="{{ route('roles.index') }}">
                                <i class="bi bi-person-fill-gear"></i> Manage Roles</a>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <a class="btn btn-success" href="{{ route('users.index') }}">
                                <i class="bi bi-people"></i> Manage Users</a>
                        @endcanany
                        @canany(['create-product', 'edit-product', 'delete-product'])
                            <a class="btn btn-warning" href="{{ route('products.index') }}">
                                <i class="bi bi-bag"></i> Manage Products</a>
                        @endcanany
                        @canany(['create-mahasiswa', 'edit-mahasiswa', 'delete-mahasiswa', 'show-mahasiswa'])
                            <a class="btn btn-dark" href="{{ route('mahasiswas.index') }}">
                                <i class="bi bi-person-badge"></i> Manage Mahasiswas</a>
                        @endcanany
                        @canany(['create-permission', 'edit-permission', 'delete-permission', 'show-permission'])
                            <a class="btn btn-info" href="{{ route('permissions.index') }}">
                                <i class="bi bi-door-open"></i> Manage Permissions</a>
                        @endcanany
                            <p>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection



{{-- yang lama --}}
{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                        <p>This is your application dashboard.</p>
                        @canany(['create-role', 'edit-role', 'delete-role'])
                            <a class="btn btn-primary" href="{{ route('roles.index') }}">
                                <i class="bi bi-person-fill-gear"></i> Manage Roles</a>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])
                            <a class="btn btn-success" href="{{ route('users.index') }}">
                                <i class="bi bi-people"></i> Manage Users</a>
                        @endcanany
                        @canany(['create-product', 'edit-product', 'delete-product'])
                            <a class="btn btn-warning" href="{{ route('products.index') }}">
                                <i class="bi bi-bag"></i> Manage Products</a>
                        @endcanany
                        @canany(['create-mahasiswa', 'edit-mahasiswa', 'delete-mahasiswa', 'show-mahasiswa'])
                            <a class="btn btn-info" href="{{ route('mahasiswas.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-backpack" viewBox="0 0 16 16">
                                    <path
                                        d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14M4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10z" />
                                    <path
                                        d="M6 2.341V2a2 2 0 1 1 4 0v.341c2.33.824 4 3.047 4 5.659v5.5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5V8a6 6 0 0 1 4-5.659M7 2v.083a6 6 0 0 1 2 0V2a1 1 0 0 0-2 0m1 1a5 5 0 0 0-5 5v5.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8a5 5 0 0 0-5-5" />
                                </svg>
                                 Manage Mahasiswas</a>
                        @endcanany
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
