@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
@endsection
