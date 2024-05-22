<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\View\View;

class SongController extends Controller
{
    public function index(): View
    {
        return view("song.index", ["songs" => Song::all()]);
    }
}
