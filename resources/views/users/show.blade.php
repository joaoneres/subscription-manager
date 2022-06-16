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
        <h1>See User</h1>
        <h3>{{ $user->name }}</h3>
        <a href="{{ route('users.index') }}" class="btn btn-primary mb-3">Back</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Document</th>
                        <th scope="col">Is Admin</th>
                        <th scope="col">Created at</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->document }}</td>
                        <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->created_at->diffForHumans(now()) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
