<?php

namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;

class StudentRoomController extends Controller
{
    public function show()
    {
        return view('students.rooms.show', [
            'room' => auth()->user()->profile->room
        ]);
    }
}
