<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class TeacherRoomController extends Controller
{
    public function show()
    {
        $room = auth()->user()->room;

        if (request('display') === 'students') {
            $students = StudentProfile::latest()->filter(request(['display']))->get();
        }

        if (request('display') === 'subjects') {
            $schedules = Schedule::where('room_id', $room->id)->latest()->filter(request(['display']))->get();
        }

        return view('teachers.rooms.show', [
            'room' => $room,
            'students' => $students ?? [],
            'schedules' => $schedules ?? []
        ]);
    }
}
