<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\PasswordReset\PasswordEmailRequest;
use App\Http\Requests\Auth\PasswordReset\PasswordResetRequest;
use App\Http\Requests\Auth\PasswordReset\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetController
{
    public function request(): View
    {
        return view('auth.password.request');
    }
    public function email(PasswordEmailRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->validated());
        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }
    public function reset(PasswordResetRequest $request, string $token): View
    {
        return view('auth.password.reset', ['token' => $token, ...$request->validated()]);
    }
    public function update(PasswordUpdateRequest $request, string $token): RedirectResponse
    {
        $status = Password::reset(
            [...$request->validated(), 'token' => $token],
            function (User $user, string $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(null);

                $user->save();

                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => [__($status)]]);
    }
}
