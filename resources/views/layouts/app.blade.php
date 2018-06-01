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
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="{{asset('js/jquery.materialize-autocomplete.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown-button").dropdown();
            $(".button-collapse").sideNav();
            $('select').material_select();
            $('.modal').modal();
            $('.alert-close').click(function () {
                $('.alert').fadeOut("slow", function () {
                });
            });
            var multiple = $('#multipleInput').materialize_autocomplete({
                multiple: {
                    enable: true,
                    maxSize: 30,
                    onAppend: function(item) {
                        console.log('length1: ' + $('.chip').length);
                        if($('.chip').length > 0)
                            $('.hide-members').css({ 'display' : 'block'});
                    },
                    onRemove: function (item) {
                        console.log('length1-r: ' + $('.chip').length);
                        if($('.chip').length == 0)
                            $('.hide-members').css({ 'display' : 'none'});
                    },
                },
                hidden: {
                    enable: true,
                    inputName: 'members'
                },
                dropdown: {
                    el: '#multipleDropdown'
                },
                appender: {
                    el: '.ac-users',
                    tagTemplate: '<div class="chip" data-id="<%= item.id %>" data-text="<%= item.text %>"><%= item.text %><i class="material-icons close">close</i></div>'
                },
                     getData: function(value, callback) {
                        var members = [];
                        var data = [];
                        @if(isset($project))
                            @foreach($project->members as $member)
                                members.push('{{$member->getFullName()}}');
                            @endforeach
                        @endif
                        @foreach($users as $user)
                          if(!members.includes('{{$user->getFullName()}}')){
                                var obj = {};
                                obj.id = {{$user->id}};
                                obj.text = '{{$user->getFullName()}}'
                                data.push(obj);
                            }
                        @endforeach
                        data = data.filter(function(el){
                            console.log(el.text.toLowerCase().indexOf(value.toLowerCase()));
    	    		        return el.text.toLowerCase().indexOf(value.toLowerCase()) == 0;
    	    	        });
                        console.log(data);

                        callback(value, data);
                     }
                });
                var multipleTickets = $('#multipleInputTickets').materialize_autocomplete({
                multiple: {
                    enable: true,
                    maxSize: 30,
                    onAppend: function(item) {
                        console.log('lenght2: '+$('.chip').length);


                        if($('.chip').length > 0)
                            $('.hide-members').css({ 'display' : 'block'});
                    },
                    onRemove: function (item) {
                    console.log('lenght: '+$('.chip'));
                        if($('.chip').length == 0)
                            $('.hide-members').css({ 'display' : 'none'});
                    }
                },
                hidden: {
                    enable: true,
                    inputName: 'membersTickets'
                },
                dropdown: {
                    el: '#multipleDropdown'
                },
                appender: {
                    el: '.ac-users-tickets',
                    tagTemplate: '<div class="chip" data-id="<%= item.id %>" data-text="<%= item.text %>"><%= item.text %><i class="material-icons close">close</i></div>'
                },
                     getData: function(value, callback) {
                        var data = [];
                        @if(isset($project))
                            @foreach($project->members as $member)
                                    var obj = {};
                                    obj.id = {{$member->id}};
                                    obj.text = '{{$member->getFullName()}}'
                                    data.push(obj);
                            @endforeach
                        @endif
                        data = data.filter(function(el){
                            console.log(el.text.toLowerCase().indexOf(value.toLowerCase()));
    	    		        return el.text.toLowerCase().indexOf(value.toLowerCase()) == 0;
    	    	        });
                        console.log(data);

                        callback(value, data);
                     }
                });
            @if(Auth::check())
             var open = {{Auth::user()->tickets->where('closed', false)->count()}};
                var closed = {{Auth::user()->tickets->where('closed', true)->count()}};
                console.log(open);
                console.log(closed);
                new Chart(document.getElementById("issuesOpenedChart"), {
                    type: 'bar',
                    data: {
                        labels: ["Opened", "Closed",],
                        datasets: [
                            {
                                label: "Opened to Closed Issues",
                                backgroundColor: ["#3e95cd", "#8e5ea2",],
                                data: [open, closed]
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                    stepSize: 1
                                }
                            }]
                        }
                    },
                });
                var low = {{Auth::user()->tickets->where('closed',false)->where('priority', 'low')->count()}};
                var medium = {{Auth::user()->tickets->where('closed',false)->where('priority', 'medium')->count()}};
                var high = {{Auth::user()->tickets->where('closed',false)->where('priority', 'high')->count()}};
                new Chart(document.getElementById("issuesPriorityChart"), {
                    type: 'doughnut',
                    data: {
                        labels: ["Low", "Medium", "High"],
                        datasets: [
                            {
                                label: "Opened Issues",
                                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                                data: [low, medium, high]
                            }
                        ]
                    }
                });
                var projectLabels = [];
                var issues = [];
                @foreach(Auth::user()->projects as $project)
                    projectLabels.push('{{$project->name}}');
                    issues.push({{$project->getUserTickets(Auth::user()->id)->count()}});

                @endforeach
                new Chart(document.getElementById("issuesToProjectsChart"), {
                    type: 'horizontalBar',
                    data: {
                        labels: projectLabels,
                        datasets: [
                            {
                                label: "Issues per project",
                                data: issues
                            }
                        ]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: 'Number of tickets per project'
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value) { if (Number.isInteger(value)) { return value; } },
                                    stepSize: 1
                                }
                            }]
                        }
                    },
                });
            @endif
        });
    </script>
</body>
</html>


