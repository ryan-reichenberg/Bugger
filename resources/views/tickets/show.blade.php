@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
            @include('partials.sidenav')
            @include('partials.errors')
            @include('partials.flash')
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Ticket: {{$ticket->name}}
                                @switch($ticket->priority)
                                    @case('low')
                                        <span class="new badge green lighten-2" right data-badge-caption="Low"></span>
                                    @break
                                    @case('medium')
                                        <span class="new badge orange lighten-2" data-badge-caption="Medium"></span>
                                    @break
                                    @case('high')
                                        <span class="new badge red" data-badge-caption="High"></span>
                                    @break
                                @endswitch

                            </span>
                            <p>{{$ticket->description}}</p>
                            <p>Tags:</p>
                            <div class="tags">
                                @foreach($ticket->tags as $tag)
                                    <a href="{{route('tag.remove', ['ticket_id'=> $ticket->id, 'tag_id' => $tag->id])}}"><span class="new badge {{$tag->colour}} tag tooltipped"  data-badge-caption="{{$tag->name}}" data-position="bottom" data-delay="50" data-tooltip="Click to remove this tag."></span></a>
                                @endforeach
                            </div>
                            <p>Assigned Members:</p>
                            <div class="assigned-members">

                                @foreach($ticket->members as $member)
                                    <div class="member">
                                        <a href="{{route('ticket.remove.member', ['ticket_id'=>$ticket->id, 'user_id'=> $member->id])}}" class="tooltipped"  data-position="bottom" data-delay="50" data-tooltip="Click to remove this member."><img src="https://ui-avatars.com/api/?name={{$member->getFullName()}}&size=32&background=607D8B&color=fff" alt="{{$member->getFullName()}}"></a><p class="nametag">{{$member->getFullName()}}</p>
                                    </div>
                                @endforeach
                                <a href="#assign-members" class="btn-floating btn waves-effect waves-light blue-grey add-button modal-trigger"><i class="material-icons">add</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($ticket->comments as $comment)
                    <div class="col s10">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title comment">{{$comment->user->getFullName()}} wrote:</span>
                                <p class="comment-text">{{$comment->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="fixed-action-btn horizontal click-to-toggle">
                <a class="btn-floating btn-large blue lighten-2">
                    <i class="material-icons">settings</i>
                </a>
                <ul>
                    <li><a href="#actions" class="btn-floating purple lighten-3 modal-trigger"><i class="material-icons">help_outline</i></a></li>
                    <li><a href="{{route('tickets.edit', $ticket)}}"class="btn-floating blue"><i class="material-icons">edit</i></a></li>
                    <li><a href="#priority" class="btn-floating yellow darken-1 modal-trigger"><i class="material-icons">priority_high</i></a></li>
                    <li><a href="#tags" class="btn-floating grey modal-trigger"><i class="material-icons">more</i></a></li>
                    <li><a class="btn-floating red lighten-1"><i class="material-icons">delete</i></a></li>
                </ul>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <form class="col s12" method="POST" action="{{route('comments.new')}}">
                    @csrf
                    <div class="row">
                        <div class="input-field col s10">
                            <textarea id="comment" name="description" class="materialize-textarea"></textarea>
                            <label for="comment">Leave Comment</label>
                        </div>
                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}"/>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                        <button class="btn waves-effect waves-light" type="submit" style="margin-top: 60px;">Post
                            <i class="material-icons right">send</i>
                        </button>

                    </div>

                </form>


            </div>
            <div id="tags" class="modal">
                <form method="POST" action="{{route('tags.add', $ticket)}}">
                    @csrf
                    <div class="modal-content center">
                        <h4>Add Tags:</h4>

                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Apply</button>
                    </div>
                </form>
            </div>
                <!-- Modal Structure -->
                <div id="priority" class="modal">
                    <form method="POST" action="{{route('tickets.priority')}}">
                        @csrf
                    <div class="modal-content center">
                        <h4>Change Priority:</h4>
                        <p>
                            <input class="with-gap" name="priority" type="radio" id="low" value="low" {{$ticket->priority=="low" ? 'checked=checked' : ''}}"/>
                            <label for="low">Low</label>
                        </p>
                        <p>
                            <input class="with-gap" name="priority" type="radio" id="medium" value="medium" {{$ticket->priority=="medium" ? 'checked=checked' : ''}}"/>
                            <label for="medium">Medium</label>
                        </p>
                        <p>
                            <input class="with-gap" name="priority" type="radio" id="high" value="high" {{$ticket->priority=="high" ? 'checked=checked' : ''}}"/>
                            <label for="high">High</label>
                        </p>
                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Apply</button>
                    </div>
                    </form>
                </div>
            <!-- Modal Structure -->
            <div id="assign-members" class="modal">
                <form method="POST" action="{{ route('ticket.add.members') }}" id="assign-members" autocomplete="off">
                    @csrf
                    <div class="modal-content">
                        <h4>Assign members to {{$ticket->name}}</h4>
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
                        <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection