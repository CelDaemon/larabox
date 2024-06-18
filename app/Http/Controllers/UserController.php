<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:update,user', only: ['update', 'updatePassword']),
            new Middleware('can:delete,user', only: ['destroy']),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user, true);
        event(new Registered($user));
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validated());
        if($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
        } else {
            $user->save();
        }
        return back()->with('status', __('Successfully updated profile!'));
    }
    public function updatePassword(UpdateUserPasswordRequest $request, User $user): RedirectResponse
    {
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('password.status', __('Successfully updated password!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('home');
    }
}
