<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PlaylistTest extends TestCase
{
    public function test_adding_a_playlist_returns_a_valid_redirect()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post(route('playlists.store'), [
            'title' => 'Foobar',
            'is_public' => false
        ])->assertValid()->assertRedirect();
    }
}
