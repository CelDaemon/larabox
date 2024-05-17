<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    public function middleware(): array
    {
        return [
            new Middleware("auth", except: ["show"])
        ];
    }

    public function index(Request $request): View
    {
        Gate::authorize("viewAny", Playlist::class);
        /** @var User $user */
        $user = $request->user();
        return view("playlist.index", ["playlists" => $user->playlists]);
    }
    public function create(): View
    {
        Gate::authorize("create", Playlist::class);
        return view("playlist.create");
    }
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize("create", Playlist::class);
        $validated = $request->validate([
            "title" => ["required", "string", "max:255"]
        ]);
        $request->user()->playlists()->create($validated);
        return redirect(route("playlist.index"));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Playlist $playlist): View
    {
        if(($response = Gate::inspect("view", $playlist))->denied()) {
            Auth::authenticate();
            $response->authorize();
        }
        return view("playlist.show", ["playlist" => $playlist, "songs" => $playlist->songs]);
    }
    public function update(Request $request, Playlist $playlist): RedirectResponse
    {
        Gate::authorize("update", $playlist);
        $validated = $request->validate([
            "title" => ["string", "max:255"]
        ]);
        $playlist->is_public = $request->boolean("public") ?? false;
        $playlist->fill($validated);
        $playlist->save();
        return redirect(route("playlist.show", [$playlist]));
    }
    public function destroy(Playlist $playlist): RedirectResponse
    {
        Gate::authorize("delete", $playlist);
        $playlist->delete();
        return redirect(route("playlist.index"));
    }
}
