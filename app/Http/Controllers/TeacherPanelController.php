<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assignment;
use App\Models\Module;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\DB;

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

//        $modules = Module::query()
//            ->where('schedule_id', 4)
//            ->whereHas('user', function ($query) {
//               $query->where('profile_type', 'App\Models\StudentProfile');
//            })->distinct()->count('user_id');

        $room = Room::firstWhere('adviser_id', auth()->user()->id);
        $students = auth()->user()->room->students->count();
        $schedules = Schedule::where('teacher_id', auth()->user()->id)->with('subject')->get();


        $modules = Module::query()
            ->whereHas('schedule', function ($query) {
                $query->where('room_id', auth()->user()->room->id);
            })->get();

        return view('teachers.index', compact('room', 'students', 'schedules', 'latestModule', 'latestAnswer', 'modules'));
    }
}
