<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function room(): HasOne
    {
        return $this->hasOne(Room::class);
    }

    public function gradeAndSection(): string
    {
        $grade = Grade::find($this->grade->id);

        return $grade->name . ' - ' . $this->name;
    }

}
