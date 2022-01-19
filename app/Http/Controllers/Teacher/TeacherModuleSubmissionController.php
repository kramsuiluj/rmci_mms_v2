<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Validation\Rule;

class TeacherModuleSubmissionController extends Controller
{
    public function receive(Schedule $schedule, User $student)
    {
        return view('teachers.modules.receive', compact('schedule', 'student'));
    }

    public function record()
    {
        $attributes = request()->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')
            ],
            'schedule_id' => [
                'required',
                Rule::exists('schedules', 'id')
                    ->where('teacher_id', auth()->user()->id),
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'module' => [
                'required',
                'min:5',
                'max:40',
                'alphanumeric_spaces',
                Rule::unique('modules', 'module')
            ]
        ]);

        Module::create($attributes);

        return redirect(route('teacher.index'))
            ->with('success', 'You have successfully recorded a module!');
    }

}
