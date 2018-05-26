@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.errors')
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card">


                <div class="card-content">
                    <span class="card-title">{{ __('Register') }}</span>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">person_outline</i>
                                <label for="fName">{{ __('First Name') }}</label>
                                <input id="fName" type="text"  name="fName" value="{{ old('fName') }}" required autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">person_outline</i>
                                <label for="lName">{{ __('Last Name') }}</label>
                                <input id="lName" type="text"  name="lName" value="{{ old('lName') }}" required autofocus>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class=" input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" name="password_confirmation" required>

                        </div>
                        </div>
                        <div class="row">
                            <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                {{ __('Register') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
