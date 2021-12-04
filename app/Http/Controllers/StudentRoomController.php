<?php

namespace App\Http\Controllers;


class StudentRoomController extends Controller
{
    public function show()
    {
        $room = auth()->user()->profile->room;
        return view('students.rooms.show', [
            'room' => $room
        ]);
    }
}
