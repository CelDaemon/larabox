<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();

        $user = User::factory()->withBeta()
            ->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Playlist::factory(2)->for($user, "owner")->has(Song::factory(10)->has(Artist::factory(2)))->create();
    }
}
