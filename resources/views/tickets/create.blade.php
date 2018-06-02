@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="container">
            @include('partials.sidenav')
            @include('partials.errors')
            <div class="row">
                <div class="col s8 offset-s2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title center">{{ __('New Ticket for project: '.$project->name) }}</span>
                            <form method="POST" action="{{ route('tickets.store') }}" id="create-issue" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">create_new_folder</i>
                                        <label for="name">{{ __('Ticket Name') }}</label>
                                        <input id="text" type="text"  name="name" value="{{ old('name') }}" required autofocus>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">description</i>
                                        <label for="description">{{ __('Ticket Description') }}</label>
                                        <textarea id="description"  class="materialize-textarea" name="description" value="{{ old('description') }}" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p><i class="material-icons prefix">priority_high</i>Priority</p>
                                        <div class="radio-buttons">
                                            <p>
                                                <input  class="with-gap" name="priority" type="radio" id="test1" checked="checked" value="low"/>
                                                <label for="test1">Low</label>
                                            </p>
                                            <p>
                                                <input  class="with-gap" name="priority" type="radio" id="test2" value="medium" />
                                                <label for="test2">Medium</label>
                                            </p>
                                            <p>
                                                <input class="with-gap" name="priority" type="radio" id="test3"  value="high" />
                                                <label for="test3">High</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if(!Auth::user()->manager)
                                    <input type="hidden" name="user" value="{{Auth::user()->id}}">
                                    @endif
                                @if(Auth::user()->manager)
                                <div class="row">

                                    <div class="input-field col s12">
                                        <div class="autocomplete" id="multipleTickets">
                                            <div class="ac-input">
                                                <i class="material-icons prefix icon">assignment_ind</i>
                                                <label class="active" for="multipleInputTickets">Assign Members</label>
                                                <input type="text" id="multipleInputTickets" placeholder="Enter members name..." data-activates="multipleDropdown" data-beloworigin="true" autocomplete="off">
                                            </div>
                                            <ul id="multipleDropdown" class="dropdown-content ac-dropdown"></ul>
                                            <input type="hidden" name="multipleHidden" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="hide-members">Assigned members:</p>
                                    <div class="ac-users-tickets"></div>
                                </div>
                                @endif
                                <input type="hidden" name="project_id" value="{{$project->id}}">

                                <div class="row">
                                    <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                        {{ __('Create Ticket') }}
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection