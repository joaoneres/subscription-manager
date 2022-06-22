<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    public function created(Product $product)
    {
        //
    }

    public function updated(Product $product)
    {
        //
    }

    public function deleted(Product $product)
    {
        Log::alert('Opa! Deletado');
    }

    public function restored(Product $product)
    {
        //
    }

    public function forceDeleted(Product $product)
    {
        Log::alert('Opa! Force deleted!');
    }
}
