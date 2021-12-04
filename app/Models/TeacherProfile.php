<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): MorphOne
    {
        return $this->morphOne('App\Models\User', 'profile');
    }


}
