@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ __('Settings') }}</h3>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Locale') }}</h5>

                        <form action="{{ route('settings.locale') }}" method="POST">
                            @csrf

                            <x-select-input :col="'12'" :selected="auth()->user()->locale" :options="App\Enums\LocaleEnum::toSelectInput()" :field="'locale'" :mb="'3'" />

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
