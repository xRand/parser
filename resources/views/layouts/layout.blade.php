<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Объявления о продаже авто</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/responsive.css') }}">
</head>
<body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    @include('partials/navbar')

    @yield('header')

    <div class="content-area">
        <hr>
        <div class="container">
            @yield('content')
        </div>
        <hr>
        <div class="footer-area">
            <div class="container">
                <div class="row footer-copy text-center">
                    <p><span>Copyright (C) 2016 Ilja Krupins</span></p>
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
