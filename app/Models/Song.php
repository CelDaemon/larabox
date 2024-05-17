<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        "title"
    ];

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }
}
