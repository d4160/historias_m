<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Monserrat:400,500,600,700&display=swap" rel="stylesheet">

    {{--  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">  --}}

    <style>
        body{
        padding: 50px;
        font-family: 'Monserrat', sans-serif;
        background-color: #F5F5F5;
        }
        /*Sign In Form*/
        .signin{
        position: relative;
        height: 700px;
        width: 500px;
        margin: auto;
        box-shadow: 0px 30px 125px -5px #000;}
        /*Background Img*/
        .back-img{
        position: relative;
        width: 100%;
        height: 250px;
        background: url('https://www.omnihotels.com/-/media/images/hotels/nycber/destinations/nyc-aerial-skyline.jpg?h=660&la=en&w=1170')no-repeat   center center;
        background-size: cover;
        }
        .layer {
            background-color: rgba(33,150,243,0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .active{
        padding-left: 25px;
        color: #fff;
        }
        .nonactive {
        color: rgba(255, 255, 255, 0.6);
        }
        .sign-in-text{
        top: 175px;
        position: absolute;
        z-index: 1;
        }
        h2 {
        padding-left: 15px;
        font-size: 25px;
        text-transform: uppercase;
        display: inline-block;
        font-weight: 300;
        }
        .point{
        position: absolute;
        z-index: 1;
        color: #fff;
        top: 235px;
        padding-left: 50px;
        font-size: 20px;
        }

        /*form-section*/
        .form-section{
        padding: 70px 90px 70px 90px;
        }
        .keep-text{
        font-size: 15px;
        color: #BDBDBD;
        }
        .forgot-text{
        font-size: 12px;
        color: #BDBDBD;
        text-align: right;
        }
        /*sign-in-btn*/
        .sign-in-btn{
        width: 100%;
        height: 75px;
        position:absolute;
        bottom:0;
        border-radius: 0px;
        background-color: rgba(63, 78, 191, 1);
        }

    </style>

    {{  $styles ?? '' }}
</head>
<body>


    <div class="signin">
        <div class="back-img">
        <div class="sign-in-text">
            <h2 class="active">Sign In</h2>
            <h2 class="nonactive">Sign Up</h2>
        </div><!--/.sign-in-text-->
        <div class="layer">
        </div><!--/.layer-->
        <p class="point">&#9650;</p>
        </div><!--/.back-img-->
        <div class="form-section">
            {{ $slot }}
        </div><!--/.form-section-->

        <p class="terms-conditions">© {{ date('Y') }} Todos los derechos reservados. <br> <a href="url"></a>
    </div><!--/.signin-->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/authentication/form-1.js') }}"></script>

    {{  $scripts ?? '' }}

</body>
</html>
