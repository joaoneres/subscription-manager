<?php

namespace App\Providers;

use App\View\Components\SingleError;
use App\View\Components\TextInput;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component(TextInput::class, 'text-input');
        Blade::component(SingleError::class, 'single-error');
    }
}
