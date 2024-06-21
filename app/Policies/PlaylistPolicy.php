<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;

class PlaylistPolicy
{
    public function create(User $user): bool
    {
        return true;
    }
    public function view(?User $user, Playlist $playlist): bool
    {
        return $playlist->is_public || $playlist->owner->is($user);
    }
    public function update(User $user, Playlist $playlist): bool
    {
        return $playlist->owner->is($user);
    }
    public function delete(User $user, Playlist $playlist): bool
    {
        return $playlist->owner->is($user);
    }


}
