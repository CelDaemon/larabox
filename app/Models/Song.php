<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $title
 * @property int $duration
 * @property Collection<Playlist> $playlists
 */
class Song extends Model
{
    use HasFactory, HasUlids;

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }
}
