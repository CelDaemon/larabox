<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view("user.register");
    }
    public function store(RegisterRequest $request): RedirectResponse
    {
        Auth::login(User::create($request->validated()));
        return redirect(route("welcome", absolute: false));
    }
}
