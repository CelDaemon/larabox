<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function index(): View
    {
        return view('verify');
    }
    public function send(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return redirect()->route('home');
    }
}
