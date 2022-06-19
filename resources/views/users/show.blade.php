@extends('layouts.app')

@section('customCss')
    <style>
        th, td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>{{ __('See') }} {{ trans_choice(__('User|Users'), 1) }}</h1>
        <h3>{{ $user->name }}</h3>
        <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">{{ __('Back') }}</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('E-mail') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('CPF/CNPJ') }}</th>
                        <th scope="col">{{ __('Is Admin') }}</th>
                        <th scope="col">{{ __('Created At') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->document }}</td>
                        <td>{{ $user->is_admin ? __('Yes') : __('No') }}</td>
                        <td>{{ $user->created_at->diffForHumans(now()) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
