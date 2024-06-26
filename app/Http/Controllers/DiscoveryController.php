<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscoveryController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('discovery', ['songs' => Song::all()]);
    }
}
