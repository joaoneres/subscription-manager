<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdatePictureRequest;
use App\Http\Requests\ProfileUpdateSimpleDataRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile.index');
    }

    public function updateAvatar(User $user, ProfileUpdatePictureRequest $request)
    {
        $path = $request->file('image')->storeAs('/users/avatars', $user->id . '.' . $request->file('image')->getClientOriginalExtension());

        $user->avatar()->updateOrCreate([], [
            'path' => $path,
            'disk' => env('FILESYSTEM_DRIVER'),
        ]);

        return redirect()->back()->withStatus(__('Avatar was successfully updated!'));
    }

    public function simpleData(User $user, ProfileUpdateSimpleDataRequest $request)
    {
        $user->update($request->safe()->all());
        return redirect()->back()->withStatus(__('Profile has been updated successfully!'));
    }
}
