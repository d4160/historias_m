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
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" /> --}}
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

        body {
            font-family: 'Poppins', sans-serif;
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

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        {{-- <!--  BEGIN CONTENT AREA  --> --}}
        <div id="content" class="main-content" style="padding-top: 5px;">
            <div class="layout-px-spacing">

                {{-- <!-- CONTENT AREA --> --}}

                {{ $slot }}

                {{-- <!-- CONTENT AREA --> --}}

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
