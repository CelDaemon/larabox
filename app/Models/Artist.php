<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 */
class Artist extends Model
{
    use HasFactory, HasUlids;

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }
}
