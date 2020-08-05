<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>
        Bono Aleman | Software
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/webfont.js') }}"></script>

    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>



    <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('css/themes/index.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />

    @yield('cs-page')
</head>


<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

<div class="m-grid m-grid--hor m-grid--root m-page">
    <header id="m_header" class="m-grid__item m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
        <div class="m-container m-container--fluid m-container--full-height">

            @include('layouts.shared._header')
        </div>
    </header>

    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            @include('layouts.shared._sidebar')


        </div>

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @yield('content')

        </div>
    </div>
    @include('sweet::alert')
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                    <span class="m-footer__copyright">{{ \Carbon\Carbon::now('America/Lima')->format('Y') }} &copy; Bono Aleman by
                        Kevin Sánchez
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/validate/form-controls.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('plugins/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@yield('component-js')
</body>
</html>

