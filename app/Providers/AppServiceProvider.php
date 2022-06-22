<?php

namespace App\Providers;

use App\View\Components\Input;
use App\View\Components\SelectInput;
use App\View\Components\SingleError;
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
        Blade::component(Input::class, 'input');
        Blade::component(SingleError::class, 'single-error');
        Blade::component(SelectInput::class, 'select-input');
    }
}
