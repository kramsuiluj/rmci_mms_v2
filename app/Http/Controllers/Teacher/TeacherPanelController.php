<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Module;
use App\Models\Room;
use App\Models\Schedule;

class TeacherPanelController extends Controller
{
    public function index()
    {
        $latestAnswer = Answer::query()
            ->whereHas('assignment', function ($query) {
                $query->where('teacher_id', auth()->user()->id);
            })->latest()->limit(1)->first();

        $latestModule = Module::query()
            ->where('is_displayed', null)
            ->whereHas('schedule', function ($query) {
                $query->where('teacher_id', auth()->user()->id);
            })->latest()->limit(1)->first();

        $room = Room::firstWhere('adviser_id', auth()->user()->id);

        if (auth()->user()->room) {
            $students = auth()->user()->room->students->count();

            $modules = Module::query()
                ->whereHas('schedule', function ($query) {
                    $query->where('room_id', auth()->user()->room->id);
                })->get();
        }

        $schedules = Schedule::where('teacher_id', auth()->user()->id)->with('subject')->get();


        return view('teachers.index', [
            'room' => $room,
            'students' => $students ?? null,
            'schedules' => $schedules,
            'latestModule' => $latestModule,
            'latestAnswer' => $latestAnswer,
            'modules' => $modules ?? null
        ]);
    }
}
