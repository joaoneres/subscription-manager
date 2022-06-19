@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h1>{{ __('Edit')}} {{ trans_choice(__('User|Users'), 1) }}</h1>
                <h3>{{ $user->name }}</h3>
                <a href="{{ route('users.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @csrf
                            @method('PUT')

                            <x-text-input :col="'12'" :mb="'3'" :field="'name'" :default="$user->name" :label="__('Name')" />
                            <x-text-input :col="'12'" :mb="'3'" :field="'email'" :default="$user->email" :label="__('E-mail')" />
                            <x-text-input :col="'12'" :mb="'3'" :field="'phone'" :default="$user->phone" :label="__('Phone')" />
                            <x-text-input :col="'12'" :mb="'3'" :field="'document'" :default="$user->document" :label="__('CPF/CNPJ')" />
                            <x-select-input :col="'12'" :mb="'3'"  :selected="$user->is_admin" :options="[0 => __('No'), 1 => __('Yes')]" :field="'locale'" :required="true" :label="__('Is Admin')" />

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
