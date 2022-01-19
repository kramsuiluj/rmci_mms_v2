<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Schedule;
use App\Notifications\AnswerUpdated;
use App\Notifications\SendAnswer;
use Carbon\Carbon;

class StudentAnswerController extends Controller
{
    public function store(Schedule $schedule, Assignment $assignment)
    {
        $attributes = request()->validate([
            'assignment_id' => ['required'],
            'student_id' => ['required'],
            'status' => ['required', 'boolean'],
            'content' => ['required']
        ]);

        if (Carbon::now()->gt($assignment->expired_at)) {
            $attributes['is_late'] = 1;
        } else {
            $attributes['is_late'] = 0;
        }

        $answer = Answer::create($attributes);

        $assignment->teacher->notify(new SendAnswer($answer, auth()->user(), $assignment, $schedule));

        return redirect(route('student.assignments.index', $schedule->id))
            ->with('success', 'You have successfully sent your answer to ' . $assignment->title);
    }

    public function edit(Schedule $schedule, Assignment $assignment, Answer $answer)
    {
        return view('students.assignments.edit', compact('schedule', 'assignment', 'answer'));
    }

    public function update(Schedule $schedule, Assignment $assignment, Answer $answer)
    {
        $attributes = request()->validate([
            'content' => ['required']
        ]);

        $update = [];

        if ($answer->content !== $attributes['content']) {
            $update['content'] = $attributes['content'];
        }

        if (!empty($update)) {
            $answer->update($update);

            $assignment->teacher->notify(new AnswerUpdated($answer, auth()->user(), $assignment, $schedule->subject, $schedule));

            return redirect(route('student.assignments.show', [$schedule->id, $assignment->id]))
                ->with('success', 'You have successfully updated your answer!');
        } else {
            return back()->with('success', 'You did not updated your answer.');
        }
    }

    public function destroy(Schedule $schedule, Assignment $assignment, Answer $answer)
    {
        $answer->delete();

        return redirect(route('student.assignments.show', [$schedule->id, $assignment->id]))
            ->with('success', 'You have successfully removed the answer you selected!');
    }
}
