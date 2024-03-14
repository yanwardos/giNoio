<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }} ">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }} ">

    @yield('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header   navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <svg class="mx-2 brand-image-xl" fill="#1f2d3d" width="50px" height="50px" viewBox="0 0 100 100"
                    id="Layer_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g>
                        <path
                            d="M93.998,45.312c0-3.676-1.659-7.121-4.486-9.414c0.123-0.587,0.184-1.151,0.184-1.706c0-4.579-3.386-8.382-7.785-9.037   c0.101-0.526,0.149-1.042,0.149-1.556c0-4.875-3.842-8.858-8.655-9.111c-0.079-0.013-0.159-0.024-0.242-0.024   c-0.04,0-0.079,0.005-0.12,0.006c-0.04-0.001-0.079-0.006-0.12-0.006c-0.458,0-0.919,0.041-1.406,0.126   c-0.846-4.485-4.753-7.825-9.437-7.825c-5.311,0-9.632,4.321-9.632,9.633v65.918c0,6.723,5.469,12.191,12.191,12.191   c4.46,0,8.508-2.413,10.646-6.246c0.479,0.104,0.939,0.168,1.401,0.198c2.903,0.185,5.73-0.766,7.926-2.693   c2.196-1.927,3.51-4.594,3.7-7.51c0.079-1.215-0.057-2.434-0.403-3.638c3.796-2.691,6.027-6.952,6.027-11.621   c0-3.385-1.219-6.635-3.445-9.224C92.731,51.505,93.998,48.471,93.998,45.312z M90.938,62.999c0,3.484-1.582,6.68-4.295,8.819   c-2.008-3.196-5.57-5.237-9.427-5.237c-0.828,0-1.5,0.672-1.5,1.5s0.672,1.5,1.5,1.5c3.341,0,6.384,2.093,7.582,5.208   c0.41,1.088,0.592,2.189,0.521,3.274c-0.138,2.116-1.091,4.051-2.685,5.449c-1.594,1.399-3.641,2.094-5.752,1.954   c-0.594-0.039-1.208-0.167-1.933-0.402c-0.74-0.242-1.541,0.124-1.846,0.84c-1.445,3.404-4.768,5.604-8.465,5.604   c-5.068,0-9.191-4.123-9.191-9.191V16.399c0-3.657,2.975-6.633,6.632-6.633c3.398,0,6.194,2.562,6.558,5.908   c-2.751,1.576-4.612,4.535-4.612,7.926c0,0.829,0.672,1.5,1.5,1.5s1.5-0.671,1.5-1.5c0-3.343,2.689-6.065,6.016-6.13   c3.327,0.065,6.016,2.787,6.016,6.129c0,0.622-0.117,1.266-0.359,1.971c-0.057,0.166-0.084,0.34-0.081,0.515   c0.001,0.041,0.003,0.079,0.007,0.115c-0.006,0.021-0.01,0.035-0.01,0.035c-0.118,0.465-0.006,0.959,0.301,1.328   c0.307,0.369,0.765,0.569,1.251,0.538c0.104-0.007,0.208-0.02,0.392-0.046c3.383,0,6.136,2.753,6.136,6.136   c0,0.572-0.103,1.159-0.322,1.849c-0.203,0.635,0.038,1.328,0.591,1.7c2.434,1.639,3.909,4.329,4.014,7.242   c0,0.004-0.001,0.008-0.001,0.012c0,5.03-4.092,9.123-9.122,9.123s-9.123-4.093-9.123-9.123c0-0.829-0.672-1.5-1.5-1.5   s-1.5,0.671-1.5,1.5c0,6.685,5.438,12.123,12.123,12.123c2.228,0,4.31-0.615,6.106-1.668C89.88,57.539,90.938,60.212,90.938,62.999   z" />
                        <path
                            d="M38.179,6.766c-4.684,0-8.59,3.34-9.435,7.825c-0.488-0.085-0.949-0.126-1.407-0.126c-0.04,0-0.079,0.005-0.12,0.006   c-0.04-0.001-0.079-0.006-0.12-0.006c-0.083,0-0.163,0.011-0.242,0.024c-4.813,0.253-8.654,4.236-8.654,9.111   c0,0.514,0.049,1.03,0.149,1.556c-4.399,0.655-7.785,4.458-7.785,9.037c0,0.554,0.061,1.118,0.184,1.706   c-2.827,2.293-4.486,5.738-4.486,9.414c0,3.159,1.266,6.193,3.505,8.463c-2.227,2.589-3.446,5.839-3.446,9.224   c0,4.669,2.231,8.929,6.027,11.621c-0.347,1.204-0.482,2.423-0.402,3.639c0.19,2.915,1.503,5.582,3.699,7.509   c2.196,1.928,5.015,2.879,7.926,2.693c0.455-0.03,0.919-0.096,1.4-0.199c2.138,3.834,6.186,6.247,10.646,6.247   c6.722,0,12.191-5.469,12.191-12.191V16.399C47.811,11.087,43.49,6.766,38.179,6.766z M44.811,82.317   c0,5.068-4.123,9.191-9.191,9.191c-3.697,0-7.02-2.2-8.464-5.604c-0.241-0.567-0.793-0.914-1.381-0.914   c-0.154,0-0.311,0.023-0.465,0.074c-0.724,0.235-1.338,0.363-1.933,0.402c-2.119,0.139-4.158-0.556-5.751-1.954   c-1.594-1.398-2.547-3.333-2.685-5.449c-0.076-1.16,0.125-2.336,0.598-3.495c0.007-0.017,0.005-0.036,0.011-0.053   c1.342-3.056,4.225-4.953,7.597-4.953c0.829,0,1.5-0.672,1.5-1.5s-0.671-1.5-1.5-1.5c-3.938,0-7.501,2.007-9.548,5.239   c-2.701-2.139-4.277-5.327-4.277-8.802c0-2.787,1.06-5.46,2.978-7.549c1.796,1.053,3.879,1.668,6.107,1.668   c6.685,0,12.123-5.438,12.123-12.123c0-0.829-0.671-1.5-1.5-1.5s-1.5,0.671-1.5,1.5c0,5.03-4.092,9.123-9.123,9.123   s-9.123-4.093-9.123-9.123c0-0.002-0.001-0.004-0.001-0.006c0.103-2.915,1.578-5.607,4.013-7.248   c0.553-0.372,0.793-1.064,0.591-1.699c-0.22-0.691-0.322-1.278-0.322-1.85c0-3.376,2.741-6.125,6.195-6.125   c0.007,0,0.015,0,0.022,0c0.103,0.014,0.206,0.027,0.311,0.034c0.485,0.03,0.948-0.171,1.254-0.542   c0.307-0.372,0.417-0.868,0.294-1.334c0-0.001-0.003-0.014-0.008-0.031c0.003-0.035,0.006-0.067,0.007-0.095   c0.005-0.18-0.022-0.359-0.081-0.529c-0.242-0.707-0.359-1.352-0.359-1.972c0-3.342,2.688-6.065,6.016-6.129   c3.328,0.065,6.016,2.787,6.016,6.13c0,0.829,0.671,1.5,1.5,1.5s1.5-0.671,1.5-1.5c0-3.391-1.861-6.35-4.612-7.926   c0.364-3.346,3.16-5.908,6.558-5.908c3.657,0,6.632,2.976,6.632,6.633V82.317z" />
                    </g>
                </svg>
                <span class="brand-text text-bold ">{{ config('app.name') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                @auth
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="https://placehold.co/160" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                {{ auth()->user()->name }}
                            </a>
                        </div>
                    </div>

                @endauth

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{ route('medis.dashboard') }}"
                                class="nav-link {{ Route::is('medis.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">PASIEN</li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('medis.pasienList') ? 'active' : '' }}"
                                href="{{ route('medis.pasienList') }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Seluruh Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is(' ') ? 'active' : '' }}"
                                href="{{ route('medis.pasienList') }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Daftarkan Pasien</p>
                            </a>
                        </li>
                        <li class="nav-header">REKAM MEDIS</li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('medis.riwayatList') ? 'active' : '' }}"
                                href="{{ route('medis.riwayatList') }}">
                                <i class="fas fa-history nav-icon"></i>
                                <p>Riwayat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is(' ') ? 'active' : '' }}" href="#">
                                <i class="far fa-history nav-icon"></i>
                                <p>Rekam</p>
                            </a>
                        </li>

                        <li class="nav-header">SISTEM</li>
                        @auth
                            <li class="nav-item">
                                <a class="  nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt nav-icon"></i>
                                    <p>
                                        {{ __('Logout') }}
                                    </p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @yield('content-header')
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content-main')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer main-footer-light">
            <strong>Copyright &copy; 2024 <a href="#">IGoniometer</a>.</strong>
            {{-- All rights reserved. --}}
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

    @yield('scripts')
    {{--
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('js/pages/dashboard.js') }}"></script> --}}
</body>

</html>
