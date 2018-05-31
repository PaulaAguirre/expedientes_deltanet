<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DocF|DCingenieria</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/lupa.png')}}" >
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color: #8eb4cb">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="#" style="color: #122b40">
                        DocF
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"></a></li>

                        @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{ Auth::user()->name }}<b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu">
                                       <li>
                                           Cerrar sesion {{Auth::logout ()}}
                                       </li>
                                    </ul>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>



    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>
