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
                            <span class="card-title center">{{ __('Edit Ticket') }}</span>
                            <form method="POST" action="{{ route('tickets.update', $ticket) }}" id="edit-issue" autocomplete="off">
                                @csrf
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">create_new_folder</i>
                                        <label for="name">{{ __('Ticket Name') }}</label>
                                        <input id="text" type="text"  name="name" value="{{ old('name', $ticket->name) }}" required autofocus>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">description</i>
                                        <label for="description">{{ __('Ticket Description') }}</label>
                                        <textarea id="description"  class="materialize-textarea" name="description"  required>{{ old('description', $ticket->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                        {{ __('Edit Ticket') }}
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection