<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BetaController extends Controller
{
    public function index(): View
    {
        return view('admin.beta', ['users' => User::all()]);
    }
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->is_beta = $request->has('beta');
        $user->save();
        return redirect()->route('admin.beta.index');
    }
}
