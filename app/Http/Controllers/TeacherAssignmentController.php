<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Schedule;
use App\Notifications\AssignmentPublished;
use Illuminate\Support\Facades\Notification;

class TeacherAssignmentController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('teachers.assignments.index', [
            'schedule' => $schedule,
            'assignments' => Assignment::where('schedule_id', $schedule->id)->get()
        ]);
    }

    public function show(Schedule $schedule, Assignment $assignment)
    {
        return view('teachers.assignments.show', compact('schedule', 'assignment'));
    }

    public function create(Schedule $schedule)
    {
        return view('teachers.assignments.create', compact('schedule'));
    }

    public function store(Schedule $schedule)
    {
        $attributes = request()->validate([
            'title' => ['required', 'alphanumeric_spaces', 'min:5', 'max:255'],
            'expired_at' => ['required', 'date'],
            'content' => ['required']
        ]);

        $assigment = Assignment::create([
            'teacher_id' => auth()->user()->id,
            'schedule_id' => $schedule->id,
            'title' => $attributes['title'],
            'expired_at' => $attributes['expired_at'],
            'content' => $attributes['content']
        ]);

        $students = $schedule->room->students;

        Notification::sendNow($students, new AssignmentPublished($assigment, auth()->user(), $schedule));

        return redirect(route('teacher.assignments.index', $schedule->id))
            ->with('success', 'You have successfully published an assignment!');
    }
}
