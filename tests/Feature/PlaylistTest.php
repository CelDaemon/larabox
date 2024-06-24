<?php

namespace Tests\Feature;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_playlist_creation_page_returns_success()
    {
        $this->actingAs(User::factory()->create())->get(route('playlists.create'))->assertSuccessful();
    }
    public function test_creating_playlist_adds_to_playlists_table()
    {
        $this->actingAs(User::factory()->create())->post(route('playlists.store'), Playlist::factory()->raw(['is_public' => false]))->assertValid();
        $this->assertDatabaseCount(Playlist::class, 1);
    }
    public function test_deleting_playlist_removes_from_playlists_table()
    {
        $this->markTestIncomplete();
    }

    // TODO add additional tests for playlists
}
