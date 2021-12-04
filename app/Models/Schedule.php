<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['modules', 'room'];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function scopeFilter($query, array $filters)
    {
//        if ($filters['display'] === 'subjects') {
//            $query->when($filters['display'] ?? false, function ($query) {
//                $query->where('room_id', 'like', '%' . auth()->user()->room->id . '%');
//            });
//        }

        if ($filters['schedule'] ?? false) {
            $query->when($filters['schedule'] ?? false, function ($query, $schedule) {
                $query->where('id', $schedule);
            });
        }
    }
}
