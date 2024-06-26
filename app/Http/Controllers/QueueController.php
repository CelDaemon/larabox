<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class QueueController
{
    public function show(): View
    {
        $queue = Song::find(array_keys(Session::get('queue', [])));
        $total = $queue->reduce(fn(int $carry, Song $song) => $carry + $song->duration, 0);
        return view('queue', ['queue' => $queue, 'total' => $total]);
    }
    public function store(Request $request): RedirectResponse
    {
        $songs = $request->validate([
            'songs' => 'required',
            'songs.*' => ['required', 'exists:'.Song::class.',id']
        ])['songs'];
        $queue = Session::get('queue', []);
        foreach($songs as $song) {
            $queue[$song] = true;
        }
        Session::put('queue', $queue);
        return back();
    }
    public function destroy(Request $request): RedirectResponse
    {
        $songs = $request->validate([
            'songs' => 'required',
            'songs.*' => ['required', 'exists:'.Song::class.',id']
        ])['songs'];
        $queue = Session::get('queue', []);
        foreach($songs as $song) {
            unset($queue[$song]);
        }
        Session::put('queue', $queue);
        return back();
    }
}
