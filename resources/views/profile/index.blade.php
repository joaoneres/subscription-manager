@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h1>{{ __('Profile') }}</h1>
                <h3>{{ auth()->user()->name }}</h3>

                @if (auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar->url() }}" alt="" width="150" height="150" class="rounded">
                    <br>
                @endif

                <a href="{{ route('home') }}" class="btn btn-primary mt-3">{{ __('Home') }}</a>
            </div>

            <div class="col-md-9">
                @if(!auth()->user()->email_verified_at)
                <div class="row mb-3">
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <h3>{{ __('Verify your e-mail') }}</h3>

                        <button type="submit" class="btn btn-primary">{{ __('Resend e-mail verification link') }}</button>
                    </form>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.simple-data', ['user' => auth()->user()->id]) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <h3>{{ __('Basic Data') }}</h3>

                    <div class="row">
                        <x-text-input :col="'6'" :mb="'3'" :field="'name'" :default="auth()->user()->name" :label="__('Name')" />
                        <x-text-input :col="'6'" :mb="'3'" :field="'email'" :default="auth()->user()->email" :label="__('E-mail')" :readonly="true" />
                        <x-text-input :col="'6'" :mb="'3'" :field="'document'" :default="auth()->user()->document" :label="__('CPF/CNPJ')" />
                        <x-text-input :col="'6'" :mb="'3'" :field="'phone'" :default="auth()->user()->phone" :label="__('Phone')" />
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
                </form>

                <div class="row mb-3">
                    <form method="POST" action="{{ route('profile.avatar', ['user' => auth()->user()->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <h3>{{ __('Avatar') }}</h3>

                        <input required type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" accept="image/png,image/jpeg">

                        @error('image')
                            <x-single-error :message="$message" />
                        @enderror

                        <button type="submit" class="btn btn-primary mt-3">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
