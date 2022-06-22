@extends('layouts.app')

@section('additionalScripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <h1>{{ trans_choice(__('Product|Products'), 2) }}</h1>

            @if (auth()->user()->is_admin)
                <div class="col">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
                </div>
            @endif
        </div>

        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if ($product->cover)
                            <img src="{{ $product->cover->url() }}" class="card-img-top">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h4>{{ __('$') . ' ' . $product->formatedPrice() }}</h4>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->recurrent ? __('Recurrent') : __('No Recurrent') }}</li>
                            <li class="list-group-item">{{ __('Valid For A :time Period', ['time' => __(ucfirst($product->period))]) }}</li>
                        </ul>

                        <div class="card-footer">
                            <button class="btn btn-primary">{{ __('Subscribe') }}</button>

                            @if (auth()->user()->is_admin)
                                <a class="btn btn-info"
                                    href="{{ route('products.edit', ['product' => $product->id]) }}">{{ __('Edit') }}</a>
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form-{{ $product->id }}').submit();">{{ __('Delete') }}</button>

                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
