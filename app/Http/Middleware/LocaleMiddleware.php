<?php

namespace App\Http\Middleware;

use App\Enums\LocaleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $fallback_locale = Config::get('app.fallback_locale');

        if(Auth::check()) {
            App::setLocale(Auth::user()->locale);
        } else if($request->has('locale') && in_array($request->get('locale'), LocaleEnum::toArray())) {
            App::setLocale($request->get('locale'));
        } else {
            App::setLocale($fallback_locale);
        }

        return $next($request);
    }
}
