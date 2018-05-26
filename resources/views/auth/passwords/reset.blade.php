@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card">
                <span class="card-title">{{ __('Reset Password') }}</span>

                <div class="card-content">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class=" row">


                            <div class="input-field col s12">
                                <i class="material-icons prefix">mail_outline</i>
                                <label for="email" class="col-md-4">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class=" row">


                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"  name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">


                            <div class="input-field col s12">
                                <i class="material-icons prefix">lock_outline</i>
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"  name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s6 offset-s4">
                                <button type="submit" class="waves-effect waves-light btn btn-large blue-grey">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
