@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2">
                <div class="card">

                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="responsive-img logo" >
                        {{--<h3>Employee login</h3>--}}
                    </div>
                    <div class="card-content">
                        <span class="card-title">{{ __('Employee Login') }}</span>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

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
                                <div class="col s4">
                                    <label>
                                        <input type="checkbox" />
                                        <span>Remember me?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                    <button type="submit" class=" col s10 offset-s1 waves-effect waves-light btn btn-large blue-grey">
                                        {{ __('Login') }}
                                    </button>

                            </div>
                            <p class="center">
                                <a  href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
