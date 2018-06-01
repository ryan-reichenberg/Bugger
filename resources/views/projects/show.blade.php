@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
        @include('partials.sidenav')
            @include('partials.flash')
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Project: {{ $project->name  }}</span>
                            <p class="description">{{$project->description}}</p>
                            <p>Assigned Members:</p>
                            <div class="assigned-members">

                                @foreach($project->members as $member)
                                    <div class="member">
                                        <a href="{{route('project.remove.member', ['project_id'=>$project->id, 'user_id'=> $member->id])}}" class="tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Click to remove this member."><img src="https://ui-avatars.com/api/?name={{$member->getFullName()}}&size=32&background=607D8B&color=fff" alt="{{$member->getFullName()}}"></a><p class="nametag">{{$member->getFullName()}}</p>
                                    </div>
                                @endforeach
                                    <a href="#assign-members" class="btn-floating btn waves-effect waves-light blue-grey add-button modal-trigger"><i class="material-icons">add</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="title">
                            <span class="card-title" id="tickets">{{__('Tickets')}}</span>
                            <a href="{{route('tickets.create', ['id'=>$project->id])}}" class="btn waves-effect waves-light blue-grey modal-trigger"><i class="material-icons left">add</i>Add ticket</a>
                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th>Tags</th>
                                <th>Name</th>
                                <th>Assigned</th>
                                <th>Priority</th>
                                <th>Submitted</th>

                            </tr>
                            </thead>

                            <tbody>
                                @foreach($project->tickets as $ticket)
                                    <tr>
                                        <td id="tags-container">
                                            <span class="tags">
                                                @foreach($ticket->tags as $tag)
                                                   <span class="new badge {{$tag->colour}} tag"  data-badge-caption="{{$tag->name}}"></span>
                                                @endforeach
                                            </span>
                                        </td>
                                        <td>{{$ticket->name}}</td>
                                        <td id="names-container">
                                            <p>
                                            @foreach($ticket->members as $member)
                                                <span class="name">{{$member->getFullName()}}{{$loop->last ? '' : ', '}}</span>
                                                @endforeach
                                            </p>
                                        </td>
                                        <td>
                                            @switch($ticket->priority)
                                                @case('low')
                                                    <span class="new badge green lighten-2 tag" data-badge-caption="Low"></span>
                                                @break
                                                @case('medium')
                                                    <span class="new badge orange lighten-2 tag" data-badge-caption="Medium"></span>
                                                @break
                                                @case('high')
                                                    <span class="new badge red tag" data-badge-caption="High"></span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{$ticket->created_at->diffForHumans()}}</td>
                                        <td><a href="{{route('tickets.show', ['id' => $ticket->id])}}" class="waves-effect waves-light btn center tooltipped blue-grey" data-position="bottom" data-delay="50" data-tooltip="Inspect ticket"><i class="material-icons" style="font-size: 30px;">search</i></a></td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            @if(Auth::user()->manager)
                <div class="fixed-action-btn horizontal click-to-toggle">
                    <a class="btn-floating btn-large blue lighten-2">
                        <i class="material-icons">settings</i>
                    </a>
                    <ul>
                        <li><a href="{{route('projects.edit', $project)}}"class="btn-floating blue"><i class="material-icons">edit</i></a></li>
                        <li>
                            <form action="{{ url('projects' , $project->id ) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn-floating red lighten-1"><i class="material-icons">delete</i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            <!-- Modal Structure -->
            <div id="assign-members" class="modal">
                <form method="POST" action="{{ route('project.add.members') }}" id="assign-members" autocomplete="off">
                    @csrf
                    <div class="modal-content">
                        <h4>Assign members to {{$project->name}}</h4>
                        <div class="row">
                            <div class="ac-users"></div>
                        </div>
                        <div class="row">

                            <div class="input-field col s12">
                                <div class="autocomplete" id="multiple">
                                    <div class="ac-input">
                                        <i class="material-icons prefix icon">assignment_ind</i>
                                        <label class="active" for="multipleInput">Assign Members</label>
                                        <input type="text" id="multipleInput" placeholder="Enter members name..." data-activates="multipleDropdown" data-beloworigin="true" autocomplete="off">
                                    </div>
                                    <ul id="multipleDropdown" class="dropdown-content ac-dropdown"></ul>
                                    <input type="hidden" name="multipleHidden" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Assign</button>
                    </div>
                </form>
            </div>
    </div>
    </div>

    @endsection