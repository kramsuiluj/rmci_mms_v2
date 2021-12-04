<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Strand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
