@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h1>{{ __('Create') }} {{ trans_choice(__('Product|Products'), 1) }}</h1>
                <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            @include('products.partials._form')

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        {{ __('Create') }}
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
