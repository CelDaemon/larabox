<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticationController
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if(RateLimiter::tooManyAttempts($request->throttleKey(),5)) {
            $seconds = RateLimiter::availableIn($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => __('auth.throttle', ['seconds' => $seconds, 'minutes' => ceil($seconds)])
            ]);
        }
        if(!Auth::attempt($request->validated(), true)) {
            RateLimiter::hit($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => __('auth.failed')
            ]);
        }
        RateLimiter::clear($request->throttleKey());
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('home');

    }
}
