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
 * @property string $duration_string
 * @property Collection<Artist> $artists
 */
class Song extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        "title"
    ];
    public function getDurationStringAttribute(): string
    {
        $timeString = gmdate("i:s", $this->duration);
        return $timeString[0] === '0' ? substr($timeString, 1) : $timeString;
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }
}
