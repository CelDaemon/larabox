<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->admin()->create([
            'name' => 'CelDaemon',
            'email' => 'devoid@voidgroup.net',
        ]);
        Playlist::factory(2)->for($user, 'owner')->hasAttached(Song::factory())->create();
    }
}
