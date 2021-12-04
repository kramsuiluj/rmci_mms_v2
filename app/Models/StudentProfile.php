<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;

class StudentProfile extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): MorphOne
    {
        return $this->morphOne('App\Models\User', 'profile');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['display'] == 'students') {
            $query->when($filters['display'] ?? false, function ($query) {
                $query->where('room_id', 'like', '%' . auth()->user()->room->id . '%');
            });
        }
    }
}
