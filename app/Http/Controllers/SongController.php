<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SongController extends Controller
{
    public function index(): View
    {
        return view("song.index", ["songs" => Song::all()]);
    }
    public function test(Request $request): never
    {
        $request->replace(array_values($request->all()));
        $validated = $request->validate([
            "*" => "exists:".Song::class.",id"
        ]);
        dd(Song::find($validated)->toArray());
    }
}
