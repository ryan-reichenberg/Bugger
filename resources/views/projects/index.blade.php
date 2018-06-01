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
                    <th>Open Tickets</th>
                    <th>Closed Tickets</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach(Auth::user()->projects as $project)
                <tr>
                    <td>{{$project->name}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->members->count()}}</td>
                    <td>{{$project->tickets->where('closed', false)->count()}}</td>
                    <td>{{$project->tickets->where('closed', true)->count()}}</td>
                    <td><a href="{{route('projects.show', ['id' => $project->id])}}" class="waves-effect waves-light btn center tooltipped blue-grey" data-position="bottom" data-delay="50" data-tooltip="Go to project"><i class="material-icons" style="font-size: 30px;">exit_to_app</i></a></td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endsection