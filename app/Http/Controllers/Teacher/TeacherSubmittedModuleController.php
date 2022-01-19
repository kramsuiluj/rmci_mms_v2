<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Module;
use App\Models\Schedule;
use App\Notifications\CheckModule;

class TeacherSubmittedModuleController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('teachers.modules.index-by-student', [
            'modules' => Module::where('user_id', '<>', auth()->user()->id)
                ->where('schedule_id', $schedule->id)->get(),
            'schedule' => $schedule
        ]);
    }

    public function check(Schedule $schedule, Module $module)
    {
        $module->update(['status' => true]);

        $module->user->profile->notify(new CheckModule($module));

        return back()->with('success', 'You have checked a module successfully!');
    }

    public function comment(Schedule $schedule, Module $module)
    {
        return view('teachers.modules.show', [
            'schedule' => $schedule,
            'module' => $module,
            'comments' => Comment::where('module_id', $module->id)->get()
        ]);
    }

}
