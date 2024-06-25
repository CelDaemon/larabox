<?php

namespace Tests\Feature;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_playlist_creation_screen_can_be_rendered()
    {
        $this->actingAs(User::factory()->create())->get(route('playlists.create'))->assertSuccessful();
    }
    public function test_user_can_create_playlist()
    {
        $this->actingAs(User::factory()->create())->post(route('playlists.store'), Playlist::factory()->raw(['is_public' => false]))->assertValid();
        $this->assertDatabaseCount(Playlist::class, 1);
    }
    public function test_playlist_viewing_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->for($user, 'owner')->create();
        $this->actingAs($user)->get(route('playlists.show', ['playlist' => $playlist]))->assertSuccessful();
    }
    public function test_library_can_be_rendered()
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->for($user, 'owner')->create();
        $this->actingAs($user)->get(route('library'))->assertSuccessful();
    }
    public function test_playlist_editing_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->for($user, 'owner')->create();
        $this->actingAs($user)->get(route('playlists.edit', ['playlist' => $playlist]))->assertSuccessful();
    }
    public function test_user_can_delete_playlist()
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->for($user, 'owner')->create();
        $this->actingAs($user)->delete(route('playlists.destroy', ['playlist' => $playlist]));
        $this->assertDatabaseEmpty(Playlist::class);
    }
    public function test_user_can_update_playlist()
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->for($user, 'owner')->create();
        $newPlaylist = Playlist::factory()->raw();
        $this->actingAs($user)->patch(route('playlists.update', ['playlist' => $playlist]), [
            'title' => $newPlaylist['title'],
            'is_public' => $newPlaylist['is_public']
        ]);
        $playlist->refresh();
        $this->assertSame($newPlaylist['title'], $playlist->title);
        $this->assertSame($newPlaylist['is_public'], $playlist->is_public);
    }

    // TODO add additional tests for playlists
}
