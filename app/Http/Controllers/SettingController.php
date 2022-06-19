<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingLocaleUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function settings()
    {
        return view('settings.index');
    }

    public function locale(SettingLocaleUpdateRequest $request)
    {
        $user = User::find(Auth::id());
        $user->update($request->safe()->all());
        App::setLocale($user->locale);
        return redirect()->back()->withStatus(__(':name has been updated successfully!', ['name' => __('Locale')]));
    }
}
