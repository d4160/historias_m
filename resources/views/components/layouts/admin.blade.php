<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}"/>
    <link href="{{  asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    {{-- <!-- BEGIN GLOBAL MANDATORY STYLES --> --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    {{-- <!-- END GLOBAL MANDATORY STYLES --> --}}

    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES --> --}}
    <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        /*.navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }*/
        .layout-px-spacing {
            min-height: calc(100vh - 184px)!important;
        }

    </style>

    {{  $styles ?? '' }}

    @stack('styles')

    {{-- <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES --> --}}

</head>
<body class="sidebar-noneoverflow">

    {{-- <!-- BEGIN LOADER --> --}}
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    {{-- <!--  END LOADER --> --}}

    @php
        $user = Auth::user();
    @endphp

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="nav-logo align-self-center">
                <a class="navbar-brand href="/"><img style="width: auto!important; height: 80px;" alt="logo" src="{{ asset('assets/img/logo.png') }}">
                    {{--  <span class="navbar-brand-name">Yabaja</span></a>  --}}
            </div>

            <ul class="navbar-item flex-row nav-dropdowns ml-auto">
                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            {{--  <img src="assets/img/90x90.jpg" class="img-fluid" alt="admin-profile">  --}}
                            <div class="media-body align-self-center">
                                <h6><span>Hola, </span>@switch($user->user_role_id)
                                            @case(1)
                                                Super Usuario
                                                @break
                                            @case(2)
                                                Administrador
                                                @break
                                            @case(3)
                                                Doctor
                                                @break
                                            @case(4)
                                                Asistente administrativo
                                                @break
                                            @case(5)
                                                Paciente
                                                @break
                                            @default
                                                Paciente
                                        @endswitch {{ explode(' ', $user->first_names)[0] }}</h6>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>{{ __('Logout') }}</span>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            <nav id="topbar">
                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="index.html">
                            <img src="assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="/" class="nav-link"> Yabaja </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="topAccordion">

                    @if ($user->user_role_id > 0 && $user->user_role_id < 5)
                    <li class="menu single-menu active">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Pacientes</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                            <li>
                                <a href="{{ route('patients.all') }}"> Lista de Pacientes </a>
                            </li>
                            <li>
                                <a href="{{ route('patients.create') }}"> Nuevo Paciente </a>
                            </li>
                        </ul>
                    </li>

                    @elseif ($user->user_role_id === 5)
                    <li class="menu single-menu active">
                        <a href="#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Resultados en Línea</span>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                            <li>
                                <a href="{{ route('results.all') }}"> Mis Exámenes Auxiliares </a>
                            </li>
                        </ul>
                    </li>

                    @endif
                </ul>
            </nav>
        </div>
        <!--  END TOPBAR  -->

        {{-- <!--  BEGIN CONTENT AREA  --> --}}
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title mt-4">
                        <h3>{{ $bodyTitle }}</h3>
                    </div>
                </div>

                {{-- <!-- CONTENT AREA --> --}}

                {{ $slot }}

                {{-- <!-- CONTENT AREA --> --}}

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © {{ date('Y') }} <a href="/"></a>, Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
        {{-- <!--  END CONTENT AREA  --> --}}

    </div>
    {{-- <!-- END MAIN CONTAINER --> --}}

    {{-- <!-- BEGIN GLOBAL MANDATORY SCRIPTS --> --}}
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <!-- END GLOBAL MANDATORY SCRIPTS --> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
        });

        window.addEventListener("beforeunload", function (e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });
    </script>


    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> --}}

    {{  $scripts ?? '' }}

    @stack('scripts')
    @yield('scripts')

    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> --}}
</body>
</html>
