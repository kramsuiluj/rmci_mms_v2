<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;

class TeacherModuleGenerationController extends Controller
{
    public function create(Schedule $schedule, User $student)
    {
        return view('teachers.modules.generate', compact('schedule', 'student'));
    }

}
