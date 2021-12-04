<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Answer extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function submissionStatus(): string
    {
        if ($this->is_late == 0) {
            return '<p class="bg-blue-600 text-white py-1 px-5 rounded-full">' . 'On-Time' . '</p>';
        } else {
            return '<p class="bg-red-500 text-white py-1 px-5 rounded-full">' . 'Late' . '</p>';
        }
    }
}
