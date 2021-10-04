<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Atención ciudadana' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Styles -->
    <link id="vendorsbundle" href="{{ asset('assets/css/vendors.bundle.css') }}" rel="stylesheet">
    <link id="appbundle" href="{{ asset('assets/css/app.bundle.css') }}" rel="stylesheet">
    <link id="myskin" href="{{ asset('assets/css/skins/skin-master.css') }}" rel="stylesheet">

    <!-- Place favicon.ico in the root directory -->
    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}"> --}}
    <link href="{{ asset('assets/css/page-login-alt.css') }}" rel="stylesheet" media="screen, print">

</head>



<body>

    @yield('content')


    <!-- Scripts -->


</body>


</html>
