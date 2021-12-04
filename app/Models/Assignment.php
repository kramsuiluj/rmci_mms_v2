<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function convertDateTime($dateTime)
    {
        return date("h:i A, F d, Y", strtotime($dateTime));
    }

    public function remainingTime()
    {
        $expiration = Carbon::create($this->expired_at);
        $hours = $expiration->diffInRealHours(Carbon::now());
        $minutes = $expiration->diffInRealMinutes(Carbon::now());

        if (Carbon::now()->gt($expiration)) {
            return '<p class="bg-red-500 text-white py-1 px-5 rounded-full">' . 'Due' . '</p>';
        }

        if ($hours > 24) {
            return $expiration->diffInDays(Carbon::now()) . ' day(s) left';
        }

        if ($hours <= 24 && $hours > 0) {
            return $expiration->diffInRealHours() . ' hour(s) left';
        }

        if ($hours == 0) {
            return $expiration->diffInRealMinutes() . ' minute(s) left';
        }
    }
}
