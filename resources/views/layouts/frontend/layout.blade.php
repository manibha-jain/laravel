<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-SHOP HTML Template</title>
   <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css')}}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css')}}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style_home.css')}}" />
</head>
    <body>
        @include('layouts.frontend.header')
        @include('layouts.frontend.sidebar')
        <div class="container-fluid">
            @yield('content')
        </div>
        @include('layouts.frontend.footer')
    </body>
   <!-- jQuery Plugins -->
    <script src="{{ asset('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/slick.min.js')}}"></script>
    <script src="{{ asset('js/nouislider.min.js')}}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
 
</html>