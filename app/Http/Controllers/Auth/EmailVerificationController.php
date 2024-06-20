<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController
{
    public function notice(): View
    {
        return view('auth.verify-email');
    }
    public function send(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->sendEmailVerificationNotification();

        return back()->with('status', __('Verification email sent!'));
    }
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return redirect()->route('home');
    }
}
