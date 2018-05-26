@extends('layouts.app')
@section('content')
    <div class="container">
        @include('partials.errors')
        <div class="row">
            <div class="col s8 offset-s2">
                <div class="card">

                    <div class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="responsive-img logo" >
                    </div>
                    <div class="card-content">
                        <span class="card-title center">{{ __('Employee Login') }}</span>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mail_outline</i>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"  name="email" value="{{ old('email') }}" required autofocus>

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
