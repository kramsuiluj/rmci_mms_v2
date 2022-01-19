<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\StudentProfile;

class TeacherRoomController extends Controller
{
    public function show()
    {
        $room = auth()->user()->room;

        if (request('display') === 'students') {
            $students = StudentProfile::where('room_id', $room->id)->latest()->filter(request(['display']))->latest()->paginate(1)->withQueryString();
        }

        if (request('display') === 'subjects') {
            $schedules = Schedule::where('room_id', $room->id)->latest()->filter(request(['display']))->latest()->get();
        }

        return view('teachers.rooms.show', [
            'room' => $room,
            'students' => $students ?? [],
            'schedules' => $schedules ?? []
        ]);
    }
}
