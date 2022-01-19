<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    public function index()
    {
        return view('teachers.schedules.index', [
            'schedules' => auth()->user()->schedules
        ]);
    }
}
