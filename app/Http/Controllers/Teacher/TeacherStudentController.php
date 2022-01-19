<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\StudentProfile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class TeacherStudentController extends Controller
{
    public function index(Room $room)
    {
        return view('teachers.students.index', compact('room'));
    }

    public function indexBySchedule(Schedule $schedule)
    {
        return view('teachers.students.index-by-schedule', [
            'schedule' => $schedule,
            'students' => StudentProfile::where('room_id', $schedule->room->id)->filter(request(['search', 'room']))->latest()->paginate(4)->withQueryString()
        ]);
    }

    public function destroy()
    {

    }

    protected function validateStudent($user = '', $profile = ''): array
    {
        return request()->validate([
            'username' => [
                'required', 'min:5', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($user)
            ],
            'firstname' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'middlename' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'lastname' => [
                'required', 'min:2', 'alpha_spaces',
                Rule::unique('users')
                    ->where('firstname', [request('firstname')])
                    ->where('middlename', [request('middlename')])
                    ->where('lastname', [request('lastname')])
                    ->ignore($user)
            ],
            'contact' => [
                'required', 'size:11', 'starts_with:09',
                Rule::unique('teacher_profiles', 'contact')->ignore($profile)
            ],
            'gender' => [
                'required', 'alpha'
            ],
            'password' => [
                Password::min(4), 'required'
            ],
            'password_confirmation' => [
                'same:password', 'required'
            ]
        ]);

    }
}
