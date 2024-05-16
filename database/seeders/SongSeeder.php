<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run(Playlist $playlist): void
    {
//        Song::factory(10)->hasAttached(Playlist::factory()->for(User::factory()->create()))->create();
        $songs = Song::factory()->hasAttached($playlist)->create();
    }
}
