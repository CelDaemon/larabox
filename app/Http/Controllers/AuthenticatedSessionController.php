<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('login');
    }

    /**
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if(RateLimiter::tooManyAttempts($request->throttleKey(), 5)) {
            $seconds = RateLimiter::availableIn($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.throttle'), [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60)
                ]
            ]);
        }
        if(!Auth::attempt($request->validated(), true)) {
            RateLimiter::hit($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
}
