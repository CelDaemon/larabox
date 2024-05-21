<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SongController extends Controller
{
    public function index(): View
    {
        Gate::authorize("beta");
        return view("song.index", ["songs" => Song::all()]);
    }
}
