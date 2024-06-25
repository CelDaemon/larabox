<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property bool $is_public
 * @property User $owner
 * @property Collection<Song> $songs
 */
class Playlist extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title',
        'is_public'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_public' => 'bool'
        ];
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owned_by');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }
}
