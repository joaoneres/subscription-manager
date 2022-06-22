@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h1>{{ __('Edit') }} {{ trans_choice(__('Product|Products'), 1) }}</h1>
                <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @include('products.partials._form', [
                                'product' => $product
                            ])

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
