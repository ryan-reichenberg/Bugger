@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
            @include('partials.sidenav')
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Members</th>
                    <th>Open Issues</th>
                    <th>Closed Issues</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach(Auth::user()->projects as $project)
                <tr>
                    <td>{{$project->name}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->users->count()}}</td>
                    <td>{{$project->issues->where('closed', false)->count()}}</td>
                    <td>{{$project->issues->where('closed', true)->count()}}</td>
                    <td><a href="#" class="waves-effect waves-light btn center tooltipped" data-position="bottom" data-delay="50" data-tooltip="Go to project"><i class="material-icons" style="font-size: 30px;">exit_to_app</i></a></td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection