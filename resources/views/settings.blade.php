@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.sidenav')
        @include('partials.errors')
        <div class="row">
            <div class="col s8 offset-s2">
                <div class="card">


                    <div class="card-content">
                        <span class="card-title">{{ __('Settings') }}</span>
                        <form method="POST" action="{{ route('users.update') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person_outline</i>
                                    <label for="fName">{{ __('First Name') }}</label>
                                    <input id="fName" type="text"  name="fName" value="{{ old('fName', $user->fName) }}" required autofocus>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person_outline</i>
                                    <label for="lName">{{ __('Last Name') }}</label>
                                    <input id="lName" type="text"  name="lName" value="{{ old('lName', $user->lName) }}" required>

                                </div>
                            </div>

                            <div class="row">
                                <div class=" input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <label for="password">{{ __('Current Password') }}</label>
                                    <input id="password" type="password" name="current-password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <label for="new-password-confirm">{{ __('New Password') }}</label>
                                    <input id="new-password-confirm" type="password" name="new-password" >

                                </div>
                            </div>
                            <div class="row">
                                <div class=" input-field col s12">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <label for="new-password-confirm">{{ __('New Password Confirmation') }}</label>
                                    <input id="new-password-confirm" type="password" name="new-password_confirmation" >

                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                    {{ __('Update Details') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
