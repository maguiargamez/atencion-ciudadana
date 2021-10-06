<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Atención ciudadana</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/reset.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/plugins.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/css/color.css') }}">
        @yield('css')
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.ico') }}">
    </head>

    <body>

        <!--loader-->
        <div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>
        <!--loader end-->

        <div id="main">
            @include('frontend.layouts.app-header')

            <div id="wrapper">

                    @yield('content')

            </div>


        </div>
                <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
        @yield('js')

        <script>
            //var project_name= "/atencion-ciudadana";
            var project_name= "http://atencion-ciudadana.test";
            @yield('script')
        </script>


    </body>
</html>
