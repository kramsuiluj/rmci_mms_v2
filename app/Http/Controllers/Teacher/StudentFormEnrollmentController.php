<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\StudentProfile;
use App\Models\User;

class StudentFormEnrollmentController extends Controller
{
    public function create(Room $room)
    {
        return view('teachers.students.create-by-form', compact('room'));
    }

    public function store(Room $room)
    {
        $attributes = $this->validateStudent();

        $student = User::create([
            'username' => $attributes['username'],
            'firstname' => $attributes['firstname'],
            'middlename' => $attributes['middlename'],
            'lastname' => $attributes['lastname'],
            'gender' => $attributes['gender'],
            'password' => bcrypt($attributes['password'])
        ]);

        $profile = StudentProfile::create([
            'contact' => $attributes['contact'],
            'room_id' => $room->id
        ]);

        $profile->user()->save($student);

        return redirect(route('teacher.index'))
            ->with('success', 'You have successfully enrolled a student!');
    }

}
