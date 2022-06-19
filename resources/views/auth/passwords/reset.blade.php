@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update', ['locale' => App::getLocale()]) }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <x-email-input :col="'4'" :mb="'3'" :field="'email'" :default="$email ?? old('email')" :label="__('E-mail')" />
                            <x-password-input :col="'4'" :mb="'3'" :field="'password'" :label="__('Password')" />
                            <x-password-input :col="'4'" :field="'password_confirmation'" :label="__('Confirm Password')" />
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
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
