<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function strand(): BelongsTo
    {
        return $this->belongsTo(Strand::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
