<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Schedule;
use App\Models\Assignment;

class StudentAssignmentController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('students.assignments.index', [
            'schedule' => $schedule,
            'assignments' => Assignment::where('schedule_id', $schedule->id)->get()
        ]);
    }

    public function show(Schedule $schedule, Assignment $assignment)
    {
        return view('students.assignments.show', [
            'schedule' => $schedule,
            'assignment' => $assignment,
            'answer' => Answer::where('assignment_id', $assignment->id)->where('student_id', auth()->user()->id)->first()
        ]);
    }
}
