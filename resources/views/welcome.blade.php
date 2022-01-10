<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ESG Application Portal</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/landing-page.css" rel="stylesheet" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            <img src="{{asset('images/Background.png')}}" class="col-6 mt-3">
            <h1 class="mt-3 mb-4">Cafe And Playstation Management System</h1>


            @if (Route::has('login'))
            @auth
            <a href="{{ route('home') }}" style="width: 25%" class="btn btn-primary">
                <h3> Dashboard </h3>
            </a>
            @else
            <a href="{{ route('login') }}" style="width: 25%" class="btn btn-success pr-3">
                <h3> Log in </h3>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            @if (Route::has('register'))
            <a href="{{ route('register') }}" style="width: 25%" class="btn btn-primary">
                <h3> Register </h3>
            </a>
            @endif
            @endauth
            @endif


        </div>
    </header>



</body>

</html>