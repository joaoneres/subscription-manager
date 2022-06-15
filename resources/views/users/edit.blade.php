@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h1>Edit User</h1>
                <h3>{{ $user->name }}</h3>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name" class="text-md-end">{{ __('Name') }}</label>

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name"
                                        autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="email" class="text-md-end">{{ __('E-mail') }}</label>

                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                        email="email" value="{{ $user->email ?? old('email') }}" required
                                        autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="phone" class="text-md-end">{{ __('Phone') }}</label>

                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                        phone="phone" value="{{ $user->phone ?? old('phone') }}" required
                                        autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="document" class="text-md-end">{{ __('CPF/CNPJ') }}</label>

                                    <input id="document" type="text"
                                        class="form-control @error('document') is-invalid @enderror" document="document"
                                        value="{{ $user->document ?? old('document') }}" required autocomplete="document"
                                        autofocus>

                                    @error('document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="is_admin" class="text-md-end">{{ __('Administrador?') }}</label>

                                    <select required name="is_admin"
                                        class="form-control @error('is_admin') is-invalid @enderror" autofocus>
                                        <option value="1" @if ($user->is_admin) selected @endif>Sim</option>
                                        <option value="0" @if (!$user->is_admin) selected @endif>Não</option>
                                    </select>

                                    @error('is_admin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        {{ __('Edit') }}
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
