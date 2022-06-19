<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('index', User::class);
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function show(User $user)
    {
        $this->authorize('show', User::class);
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        $this->authorize('edit', User::class);
        return view('users.edit')->with('user', $user);
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $this->authorize('update', User::class);
        $user->update($request->safe()->all());
        return redirect()->route('users.index')->withStatus(__(':name has been updated successfully!', ['name' => $user->name]));
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', User::class);
        $user->delete();
        return redirect()->route('users.index')->withStatus(__(':name has been deleted successfully!', ['name' => $user->name]));
    }
}
