<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController
{
    /**
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
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
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
