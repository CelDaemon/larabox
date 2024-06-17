<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class BetaController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.beta', ['users' => User::all()]);
    }
}
