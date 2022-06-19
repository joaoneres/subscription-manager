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
        <h1>{{ trans_choice(__('User|Users'), 2) }}</h1>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('ID') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('E-mail') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($users) === 0)
                        <tr>
                            <td colspan="5">
                                <span class="text-danger">{{ __('No items available') }}</span>
                            </td>
                        </tr>
                    @endif

                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-primary">{{ __('See') }}</a>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-secondary">{{ __('Edit') }}</a>

                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
