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
        if(!empty($filters) && array_key_exists('display', $filters)) {
            $query->when($filters['display'] == 'students' ?? false, function ($query) {
                $query->when($filters['display'] ?? false, function ($query) {
                    $query->where('room_id', 'like', '%' . auth()->user()->room->id . '%');
                });
            });
        }

        if (!empty($filters && array_key_exists('search', $filters) && array_key_exists('room', $filters))) {
            $query->when($filters['search'] && $filters['room'] ?? false, function ($query) {
                $query->where('room_id', request('room'));
                $query->whereHas('user', function ($query) {
                    $query->where('firstname', 'like', '%' . request('search') . '%')
                        ->orWhere('middlename', 'like', '%' . request('search') . '%')
                        ->orWhere('lastname', 'like', '%' . request('search') . '%')
                        ->orWhere('id', 'like', '%' . request('search') . '%');
                });
            });
        }
    }
}
