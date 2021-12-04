<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Module extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Notifiable;

    protected $guarded = [];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->status === 0 ? "<p class='bg-blue-600 text-white py-1 px-3 rounded-full'>Submitted for Checking</p>" : "<p class='bg-green-600 text-white py-1 px-3 rounded-full'> Checked </p>";
    }
}
