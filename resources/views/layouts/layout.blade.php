<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parser</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>


    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ URL::to('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/responsive.css') }}">
    {{--<link rel="stylesheet" href="{{ URL::to('css/owl.carousel.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ URL::to('css/owl.theme.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ URL::to('css/owl.transitions.css') }}">--}}

</head>
<body>
{{--@include('partials/navbar')--}}
{{--@include('errors.errors')--}}
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <!-- Body content -->
    @include('partials/navbar')

    @yield('header')

    {{--@yield('slider')--}}

    <div class="content-area">
        <hr>
        <div class="container">
                @yield('content')
        </div>

        <hr>
        <div class="footer-area">
            <div class="container">
                <div class="row footer">

                </div>
                <div class="row footer-copy">
                    <p><span>(C) webstie, All rights reserved</span> | <span>Graphic Designed by <a href="https://dribbble.com/siblu">Eftakher Alam</a></span> | <span> Web Designed by <a href="http://ohidul.me">Ohidul Islam</a></span> </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('js/main.js') }}"></script>

    @yield('footer')
</body>
</html>
