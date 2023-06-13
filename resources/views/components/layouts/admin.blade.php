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
    {{--  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">  --}}

    <style>
        @font-face {
            font-family: 'Mont';
            src: url('{{ asset("assets/fonts/Mont-Regular.woff") }}');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Mont';
            src: url('{{ asset("assets/fonts/Mont-Bold.woff") }}');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Mont';
            src: url('{{ asset("assets/fonts/Mont-RegularItalic.woff") }}');
            font-weight: normal;
            font-style: italic;
        }

        @font-face {
            font-family: 'Mont';
            src: url('{{ asset("assets/fonts/Mont-BoldItalic.woff") }}');
            font-weight: bold;
            font-style: italic;
        }
    </style>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    {{-- <!-- END GLOBAL MANDATORY STYLES --> --}}

    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES --> --}}

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

    {{-- <!--  BEGIN NAVBAR  --> --}}
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <ul class="flex-row navbar-item">
                <li class="nav-item theme-logo">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo.png') }}" class="navbar-logo" alt="logo" style="height: auto; width: 112px">
                    </a>
                </li>
            </ul>

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="flex-row navbar-item search-ul">
                <li class="nav-item align-self-center search-animated">
                    {{--  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form class="form-inline search-full search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control ml-lg-auto" placeholder="Buscar...">
                        </div>
                    </form>  --}}
                </li>
            </ul>
            <ul class="flex-row navbar-item navbar-dropdown">

                <li class="order-1 nav-item dropdown user-profile-dropdown order-lg-0">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('assets/img/90x90.jpg') }}" alt="admin-profile" class="img-fluid">
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="mx-auto media">
                                <img src="{{  asset('assets/img/90x90.jpg') }}" class="mr-2 img-fluid" alt="avatar">
                                <div class="media-body">
                                    <h5>{{ $user->first_names . ' ' . $user->last_names }}</h5>
                                    <p>
                                        @switch($user->user_role_id)
                                            @case(1)
                                                Super Usuario
                                                @break
                                            @case(2)
                                                Administrador
                                                @break
                                            @case(2)
                                                Paciente
                                                @break
                                            @default
                                                Paciente
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{--  <div class="dropdown-item">
                            <a href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Mi perfil</span>
                            </a>
                        </div>  --}}
                        {{--  <div class="dropdown-item">
                            <a href="apps_mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span>My Inbox</span>
                            </a>
                        </div>  --}}
                        {{--  <div class="dropdown-item">
                            <a href="auth_lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Lock Screen</span>
                            </a>
                        </div>  --}}
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
                </li>
            </ul>
        </header>
    </div>
    {{-- <!--  END NAVBAR  --> --}}

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        {{-- <!--  BEGIN SIDEBAR  --> --}}
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="compactSidebar">
                <ul class="menu-categories">
                    
                    @if ($user->user_role_id === 1 || $user->user_role_id === 2)
                        <li class="menu active" >
                            <a href="#menu1" data-active="false" class="menu-toggle">
                                <div class="base-menu">
                                    <div class="base-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    </div>
                                    <span>Pacientes</span>
                                </div>
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </li>
                    @elseif ($user->user_role_id === 3)
                        <li class="menu">
                            <a href="#menu2" data-active="true" class="menu-toggle">
                                <div class="base-menu">
                                    <div class="base-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    </div>
                                    <span>Resultados <br>en línea</span>
                                </div>
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </li>
                    @endif

                    {{--  <li class="menu active">
                        <a href="#starterKit" data-active="true" class="menu-toggle">
                            <div class="base-menu">
                                <div class="base-icons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                                </div>
                                <span>Páginas</span>
                            </div>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </li>

                    <li class="menu">
                        <a href="javascript:void(0);" data-active="true" class="menu-toggle">
                            <div class="base-menu">
                                <div class="base-icons">
                                    <div class="base-icons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                </div>
                                </div>
                                <span>Pacientes</span>
                            </div>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </li>

                    <li class="menu">
                        <a href="javascript:void(0);" data-active="true" class="menu-toggle">
                            <div class="base-menu">
                                <div class="base-icons">
                                    <div class="base-icons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                </div>
                                </div>
                                <span>Mensajes <br>de contacto</span>
                            </div>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </li>

                    <li class="menu">
                        <a href="javascript:void(0);" data-active="true" class="menu-toggle">
                            <div class="base-menu">
                                <div class="base-icons">
                                    <div class="base-icons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                </div>
                                </div>
                                <span>Subscripciones <br>al boletín</span>
                            </div>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </li>  --}}
                </ul>
            </nav>

            <div id="compact_submenuSidebar" class="submenu-sidebar">

                <div class="submenu" id="menu1">
                    <p><strong>Pacientes</strong></p>
                    <ul class="submenu-list" data-parent-element="#menu1">
                        <li>
                            <a href="{{ route('patients.all') }}">Todos los pacientes</a>
                        </li>
                        <li>
                            <a href="{{ route('patients.create') }}">Registrar nuevo</a>
                        </li>
                    </ul>
                </div>

                <div class="submenu" id="menu2">
                    <p><strong>Resultados en línea</strong></p>
                    <ul class="submenu-list" data-parent-element="#menu2">
                        <li>
                            <a href="{{ route('results.all') }}">Mis resultados</a>
                        </li>
                    </ul>
                </div>

                {{--  <div class="submenu" id="menu2">
                    <ul class="submenu-list" data-parent-element="#menu2">
                        <li>
                            <a href="javascript:void(0);"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span> Submenu 1 </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg></span> Submenu 2 </a>
                        </li>
                    </ul>
                </div>  --}}

                {{--  <div class="submenu" id="menu3">
                    <ul class="submenu-list" data-parent-element="#menu3">
                        <li>
                            <a href="table_basic.html"> Inicio </a>
                        </li>
                        <li class="sub-submenu">
                            <a role="menu" class="collapsed" data-toggle="collapse" data-target="#datatables" aria-expanded="false"> Submenu 2 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul id="datatables" class="collapse" data-parent="#compact_submenuSidebar">
                                <li>
                                    <a href="javascript:void(0);"> Sub Submenu 1 </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"> Sub Submenu 2 </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"> Sub Submenu 3 </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"> Sub Submenu 4 </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>  --}}

                {{--  <div class="submenu show" id="starterKit">
                    <ul class="submenu-list" data-parent-element="#starterKit">
                        <li class="active">
                            <a href=""> Inicio </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> Todos los resultados </a>
                      </li>
                    </ul>
                </div>  --}}

            </div>

        </div>
        {{-- <!--  END SIDEBAR  --> --}}

        {{-- <!--  BEGIN CONTENT AREA  --> --}}
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3>{{ $bodyTitle }}</h3>
                    </div>
                </div>

                {{-- <!-- CONTENT AREA --> --}}

                {{ $slot }}

                {{-- <!-- CONTENT AREA --> --}}

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © {{ date('Y') }} <a href="https://dmiperu.com/">DMI</a>, Todos los derechos reservados.</p>
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

    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> --}}

    {{  $scripts ?? '' }}

    @stack('scripts')
    @yield('scripts')

    {{-- <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> --}}
</body>
</html>
