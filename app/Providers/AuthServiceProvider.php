<?php

namespace App\Providers;

use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-avatar', [ProfilePolicy::class, 'updateAvatar']);
        Gate::define('simple-data', [ProfilePolicy::class, 'simpleData']);
    }
}
