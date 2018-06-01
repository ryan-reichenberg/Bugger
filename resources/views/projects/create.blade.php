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
                        <span class="card-title center">{{ __('New Project') }}</span>
                        <form method="POST" action="{{ route('projects') }}" id="create-project" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">create_new_folder</i>
                                    <label for="name">{{ __('Project Name') }}</label>
                                    <input id="text" type="text"  name="name" value="{{ old('name') }}" required autofocus>

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">description</i>
                                    <label for="description">{{ __('Project Description') }}</label>
                                    <textarea id="description"  class="materialize-textarea" name="description" value="{{ old('description') }}" required></textarea>
                                </div>
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
                            <div class="row">
                                <p class="hide-members">Assigned members:</p>
                                <div class="ac-users"></div>
                            </div>
                            <div class="row">
                                <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                    {{ __('Create Project') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection