@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card">


                <div class="card-content">
                    <span class="card-title">{{ __('Register') }}</span>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">person</i>
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"  name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"  name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
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
