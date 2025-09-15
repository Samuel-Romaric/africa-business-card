<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Test">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard.">
    <meta name="keywords" content="bootstrap 5, admin dashboard, etc.">
    <title>@yield('title', 'Dashboard |') {{ config('app.name') }} </title>

    <link rel="shortcut icon" href="{{ asset('/admin/assets/africa-business-card-new-logo.png') }}" type="image/x-icon">

    <!-- Global styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/admin/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/custome.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/admin/css/flashy.css') }}"> --}}

    @stack('styles') <!-- Inclure les styles spécifiques à une page -->
    <style>
        /* .sidebar-brand {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 6em;
            padding: 0.8125rem 0.5rem;
            overflow: hidden;
            font-size: 1.25rem;
            white-space: nowrap;
            transition: width 0.3s ease-in-out;
            border-bottom: #010140;
        }

        .brand-image {
            min-height: 6em;
        } */

        .app-wrapper, .app-header, .app-main {
            background-color: white !important;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> 
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown -->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"> <img src="{{ \Auth::user()->getAvatarFullUrl() }}"
                                class="user-image rounded-circle shadow" alt="User Image"><span
                                class="d-none d-md-inline">{{ \Auth::user()->name }}</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header " style="background-color:#010140;color:white"> <img src="{{ \Auth::user()->getAvatarFullUrl() }}"
                                    class="rounded-circle shadow" alt="User Image">
                                <p>
                                    {{ \Auth::user()->name }} - Administrateur
                                    <small>Membre depuis - {{ \Auth::user()->created_at->isoFormat('mm Y') }}</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer"> <a href="{{ route('admin.profile.show') }}" class="btn btn-outline-default btn-flat"><i class="bi bi-person-badge"></i> Profile</a>
                                
                                <a href="javascript:void(0)" class="btn btn-outline-secondary btn-flat float-end"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                     <i class="bi bi-power"></i><span> Déconnexion</span>
                                     {{-- <i class="bi bi-box-arrow-right"></i><span> Déconnexion</span> --}}
                                     {{-- <em class="icon ni ni-signout"></em><span>Déconnexion</span> --}}
                                 </a>
                                 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                       style="display: none;">
                                     {{ csrf_field() }}
                                 </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.partials.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main" style="background-color:#ffffff">

            @yield('content') <!-- Section pour le contenu principal -->

            @include('layouts.partials.flash-message')
            
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        {{-- <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> --}}
    </div>

    <!-- Global scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/admin/js/adminlte.js') }}"></script>
    <script src="{{  asset('/admin/js/jquery-3.7.1.min.js')}}"></script>
    {{-- <script src="{{  asset('/admin/js/flashy.js')}}"></script> --}}

    @stack('scripts') {{-- Inclure les scripts spécifiques à une page --}}
</body>

</html>