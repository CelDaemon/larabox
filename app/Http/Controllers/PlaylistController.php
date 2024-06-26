<?php

namespace App\Http\Controllers;

use App\Http\Requests\Playlist\StorePlaylistRequest;
use App\Http\Requests\Playlist\UpdatePlaylistRequest;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PlaylistController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
            new Middleware('can:view,playlist', ['show']),
            new Middleware('can:update,playlist', ['edit', 'update']),
            new Middleware('can:delete,playlist', ['destroy'])
        ];
    }
    public function create(): View
    {
        return view('playlists.create');
    }
    public function store(StorePlaylistRequest $request): RedirectResponse
    {
        $safe = $request->safe();
        /** @var Playlist $playlist */
        $playlist = $request->user()->playlists()->create([...$safe->except('is_public'), 'is_public' => $safe->boolean('is_public')]);
        return redirect()->route('playlists.show', ['playlist' => $playlist]);
    }
    public function show(Playlist $playlist): View
    {
        return view('playlists.show', ['playlist' => $playlist]);
    }
    public function edit(Playlist $playlist): View
    {
        return view('playlists.edit', ['playlist' => $playlist]);
    }
    public function update(UpdatePlaylistRequest $request, Playlist $playlist): RedirectResponse
    {
        $safe = $request->safe();
        $playlist->fill([...$safe->except('is_public'), 'is_public' => $safe->boolean('is_public')])->save();
        return back()->with('status', __('Successfully updated playlist!'));
    }
    public function destroy(Playlist $playlist): RedirectResponse
    {
        $playlist->delete();
        return redirect()->route('library');
    }
    public function prepare(Request $request): RedirectResponse
    {
        $input = $request->input('songs');
        $request->replace(['songs' => $input !== null ? array_values($input) : null]);
        $songs = Song::find($request->validate([
            'songs' => 'required',
            'songs.*' => 'exists:'.Song::class.',id'
        ])['songs']);
        Session::flash('songs', $songs);
        return redirect()->route('playlists.select');
    }
    public function select(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();
        Session::keep('songs');
        return view('playlists.select', ['playlists' => $user->playlists]);
    }
    public function add(Playlist $playlist): RedirectResponse
    {
        $songs = Session::get('songs');
        $playlist->songs()->syncWithoutDetaching($songs);
        return redirect()->route('playlists.show', ['playlist' => $playlist]);
    }
    public function remove(Playlist $playlist, Song $song): RedirectResponse
    {
        $playlist->songs()->detach($song);
        return back();
    }
}
