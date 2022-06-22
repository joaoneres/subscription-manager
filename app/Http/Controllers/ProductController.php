<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        return view('products.index')->with('products', Product::with('cover')->get());
    }

    public function create()
    {
        return view('products.create');
    }

    private function handleCoverStorage($product, $file)
    {
        $path = $file->storeAs('/products/covers', $product->id . '.' . $file->getClientOriginalExtension());

        $product->cover()->updateOrCreate([], [
            'path' => $path,
            'disk' => env('FILESYSTEM_DRIVER'),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $this->authorize('create', Product::class);
        $product = Product::create($request->safe()->except('cover'));

        if($request->has('cover')) {
            $this->handleCoverStorage($product, $request->file('cover'));
        }

        return redirect()->back()->withStatus(__(':name has been created successfully!', ['name' => $product->name]));
    }

    public function edit(Product $product)
    {
        $this->authorize('edit', $product);
        return view('products.edit')->with('product', $product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->safe()->except('cover'));

        if($request->has('cover')) {
            $this->handleCoverStorage($product, $request->file('cover'));
        }

        return redirect()->route('products.index')->withStatus(__(':name has been updated successfully!', ['name' => $product->name]));
    }

    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);
        $product->delete();
        return redirect()->back()->withStatus(__(':name has been deleted successfully!', ['name' => $product->name]));
    }
}
