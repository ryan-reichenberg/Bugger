@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
           @include('partials.sidenav')

            @if (session('status'))
                <div class="row">
                    <div class="col alert m4">
                        <div class="card green lighten-3">

                            <span class="card-title">Alert</span>
                            <span class="alert-close"><i class="material-icons">close</i></span>
                            <div class="card-content center">

                                    {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

            <div class="row">
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Tickets Total</span>

                        <div class="card-content center">
                            <h3>{{$tickets->count()}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Tickets In Progress</span>

                        <div class="card-content center">
                            <h3>{{Auth::user()->tickets->where('closed', false)->count()}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Tickets Closed</span>

                        <div class="card-content center">
                            <h3>{{Auth::user()->tickets->where('closed', true)->count()}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Total Projects Involved</span>

                        <div class="card-content center">
                            <h3>{{Auth::user()->projects->count()}}</h3>
                        </div>
                    </div>
                </div>
        </div>
                    <div class="row">
                        <div class="col s4">
                            <div class="card ">
                                <div class="card-content center">
                                    @if(Auth::user()->tickets->where('closed', false)->count() > 0)
                                        <canvas id="issuesPriorityChart" width="400" height="300"></canvas>
                                        @else
                                           No data to display.
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="card ">

                                <div class="card-content center">
                                    @if(Auth::user()->tickets->where('closed', false)->count() > 0 || Auth::user()->tickets->where('closed', true)->count() > 0)
                                        <canvas id="issuesOpenedChart" width="400" height="300"></canvas>
                                    @else
                                        No data to display.
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col s4">
                            <div class="card ">

                                <div class="card-content center">
                                    @if(Auth::user()->anyIssuesRegistered())
                                        <canvas id="issuesToProjectsChart" width="400" height="300"></canvas>
                                    @else
                                        No data to display.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
        </div>
@endsection
