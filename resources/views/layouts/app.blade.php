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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">

    <style>
        .input-field input:focus {
            border-bottom: 1px solid #607D8B !important;
            box-shadow: 0 1px 0 0 #607D8B !important;
        }
        .input-field .prefix.active {
            color: #607D8B !important;
        }
        .padding-top{
            padding-top: 1.5rem;
        }
        .logo{
            padding: 15px;
            display: block;
            margin: 0 auto;
        }
    </style>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav>
            <div class="nav-wrapper blue-grey">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} Issue Management System
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else
                            <li><a class="dropdown-trigger" href="#!" data-target="user-dropdown">Hello, <i class="material-icons right">arrow_drop_down</i>
                                {{ Auth::user()->name }}! <span class="caret"></span>
                                </a></li>

                        <ul id="user-dropdown" class="dropdown-content">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown-trigger").dropdown();
        });
    </script>
</body>
</html>


