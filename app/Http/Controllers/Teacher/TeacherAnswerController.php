<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Notifications\AnswerChecked;
use Illuminate\Http\Request;

class TeacherAnswerController extends Controller
{
    public function index(Schedule $schedule, Assignment $assignment)
    {
        return view('teachers.answers.index', [
            'schedule' => $schedule,
            'assignment' => $assignment,
            'answers' => Answer::where('assignment_id', $assignment->id)->get()
        ]);
    }

    public function show(Schedule $schedule, Assignment $assignment, Answer $answer)
    {
        return view('teachers.answers.show', compact('schedule', 'assignment', 'answer'));
    }

    public function update(Schedule $schedule, Assignment $assignment, Answer $answer)
    {
        $attributes = request()->validate([
            'grades' => ['required', 'numeric']
        ]);

        $answer->update([
            'status' => 1,
            'grades' => (double)$attributes['grades']
        ]);

        $answer->student->profile->notify(new AnswerChecked($answer, auth()->user(), $assignment, $schedule->subject, $schedule));

        return redirect(route('teacher.answers.index', [$schedule->id, $assignment->id]))
            ->with('success', 'You have successfully checked the answer you selected!');
    }
}
