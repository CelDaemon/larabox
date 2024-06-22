<?php

namespace App\Http\Controllers;

use App\Http\Requests\Playlist\StorePlaylistRequest;
use App\Http\Requests\Playlist\UpdatePlaylistRequest;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class PlaylistController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
            new Middleware('can:create,'.Playlist::class, ['create', 'store']),
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
}
