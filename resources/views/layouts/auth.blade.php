<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>
        Bono Aleman | Login
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/webfont.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="{{ asset('css/login/vendors.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/login/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/login/index.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
</head>

<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

@yield('content')

<script src="{{ asset('js/login/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/login/scripts.bundle.js') }}" type="text/javascript"></script>

</body>

</html>
