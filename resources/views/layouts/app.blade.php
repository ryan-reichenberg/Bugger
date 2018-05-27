<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Issue Management System</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="{{ asset('css/site.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav>
            <div class="nav-wrapper blue-grey">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset("img/logo.png")}}" alt="logo" class="responsive-img nav-logo">
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else
                            <li><a class="dropdown-button" href="#!" data-activates="user-dropdown" data-beloworigin="true">Hello, <i class="material-icons right">arrow_drop_down</i>
                                {{ Auth::user()->fName }}! <span class="caret"></span>
                                </a></li>

                        <ul id="user-dropdown" class="dropdown-content">
                            <li><a href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="padding-top">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown-button").dropdown();
            $(".button-collapse").sideNav();
            $('.alert-close').click(function(){
                $( '.alert' ).fadeOut( "slow", function() {
                });
            });
        });
    </script>
</body>
</html>


