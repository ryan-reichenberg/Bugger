@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
            <ul id="slide-out" class="side-nav fixed">
                <li><a href="#!"> <i class="material-icons prefix">insert_chart</i>Dashboard</a></li>
                <li><a href="#!"> <i class="material-icons prefix">folder_open</i>Projects</a></li>
                <li><a href="#!"> <i class="material-icons prefix">person</i>Members</a></li>
                <li><a href="#!"> <i class="material-icons prefix">settings</i>Settings</a></li>
            </ul>
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
                            <h3><a href="#">{{$tickets->count()}}</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Tickets In Progress</span>

                        <div class="card-content center">
                            <h3><a href="#">{{Auth::user()->tickets->count()}}</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Tickets Closed</span>

                        <div class="card-content center">
                            <h3><a href="#">{{Auth::user()->tickets->where('closed', false)->count()}}</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col s3">
                    <div class="card ">
                        <span class="card-title">Total Projects</span>

                        <div class="card-content center">
                            <h3><a href="#">{{Auth::user()->projects->count()}}</a></h3>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        </div>
@endsection
