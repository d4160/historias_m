<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
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
    <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">

    {{  $styles ?? '' }}
</head>
<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        {{ $slot }}

                        <p class="terms-conditions">© {{ date('Y') }} Todos los derechos reservados. <br> <a href="https://dmiperu.com/">DMI</a>, Diagnóstico Médico por Imágenes.
                            {{--  <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.  --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/authentication/form-1.js') }}"></script>

    {{  $scripts ?? '' }}

</body>
</html>
