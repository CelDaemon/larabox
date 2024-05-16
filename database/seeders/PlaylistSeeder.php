<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void
    {
//        Playlist::factory(10)->for($user)->create();
        $playlist = Playlist::factory()->for($user)->create([
            "title" => "Test Playlist"
        ]);

        $this->callOnce(SongSeeder::class, parameters: ["playlist" => $playlist]);
    }
}
