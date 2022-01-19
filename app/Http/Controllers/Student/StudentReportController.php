<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Module;

class StudentReportController extends Controller
{
    public function index()
    {
        $room = auth()->user()->profile->room_id;

        if (request('section')) {
            $scheduleId = request('section');

            $teacherModules = Module::query()
                ->where('schedule_id', $scheduleId)
                ->where('is_displayed', 1)
                ->select('filename')
                ->get()
                ->toArray();

            $myModules = Module::where('schedule_id', $scheduleId)
                ->where('user_id', auth()->user()->id)
                ->select('filename')
                ->get()
                ->toArray();

            $studentModules = array_map(function ($module) {
                $module['filename'] = str_replace('-', ' ', $module['filename']);

                if (str_contains($module['filename'], auth()->user()->id)) {
                    $module['filename'] = str_replace(auth()->user()->id, '', $module['filename']);

                }

                if (str_contains($module['filename'], auth()->user()->lastname)) {
                    $module['filename'] = str_replace(auth()->user()->lastname, '', $module['filename']);
                }

                $module['filename'] = ltrim($module['filename']);

                return $module;
            }, $myModules);

            $modules = collect(array_diff(array_column($teacherModules, 'filename'), array_column($studentModules, 'filename')));

            $incompleteModules = $modules->map(function ($item) use ($scheduleId) {
                return Module::where('filename', $item)->where('schedule_id', $scheduleId)->first();
            });

            $assignments = array_column(Assignment::where('schedule_id', $scheduleId)->select('id')->get()->toArray(), 'id');
            $answers = array_column(
                Answer::query()
                    ->where('student_id', auth()->user()->id)
                    ->select('assignment_id')
                    ->whereHas('assignment', function ($query) use ($scheduleId) {
                        $query->where('schedule_id', $scheduleId);
                    })
                    ->get()
                    ->toArray(),
                'assignment_id'
            );

            $incompleteAssignmentsArr = collect(array_diff($assignments, $answers));

            $incompleteAssignmentsColl = $incompleteAssignmentsArr->map(function ($item) use ($scheduleId) {
                return Assignment::where('id', $item)->where('schedule_id', $scheduleId)->first();
            });
        }

        return view('students.reports.index', [
            'schedules' => auth()->user()->profile->room->schedules,
            'incompleteModules' => $incompleteModules ?? [],
            'incompleteAssignments' => $incompleteAssignmentsColl ?? [],
        ]);
    }
}
