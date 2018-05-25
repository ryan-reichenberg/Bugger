@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2">
            <div class="card">
                <span class="card-title">Dashboard</span>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
