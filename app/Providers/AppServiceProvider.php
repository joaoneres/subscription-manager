<?php

namespace App\Providers;

use App\View\Components\EmailInput;
use App\View\Components\PasswordInput;
use App\View\Components\SelectInput;
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
        Blade::component(SelectInput::class, 'select-input');
        Blade::component(PasswordInput::class, 'password-input');
        Blade::component(EmailInput::class, 'email-input');
    }
}
