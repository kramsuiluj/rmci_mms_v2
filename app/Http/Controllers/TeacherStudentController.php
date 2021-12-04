<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class TeacherStudentController extends Controller
{
    public function index(Room $room)
    {
        return view('teachers.students.index', compact('room'));
    }

    public function indexBySchedule(Schedule $schedule)
    {
        return view('teachers.students.index-by-schedule', compact('schedule'));
    }

    public function createByFile(Room $room)
    {
        return view('teachers.students.create-by-file', compact('room'));
    }

    public function storeByFile(Room $room)
    {
        $attributes = request()->validate([
            'students' => ['required', 'mimes:csv,xlsx', 'max:10240']
        ]);

        $students = Excel::toArray(new StudentImport(), $attributes['students']);

        array_map(function ($student) use ($room) {
            array_map(function ($s) use ($room) {
                try {
                    $user = User::create([
                        'id' => $s['id'],
                        'username' => $s['username'],
                        'firstname' => $s['firstname'],
                        'middlename' => $s['middlename'],
                        'lastname' => $s['lastname'],
                        'password' => bcrypt($s['password'])
                    ]);
                } catch (QueryException $e) {
                    throw ValidationException::withMessages([
                        'students' => $s['firstname'] . ' ' . $s['lastname'] . ' might already been enrolled or some of the data must have duplicate.'
                    ]);
                }

                $profile = StudentProfile::create([
                    'room_id' => $room->id,
                    'contact' => $s['contact']
                ]);

                $profile->user()->save(User::find($user->id));
            }, $student);
        }, $students);

        return redirect(route('teacher.index'))
            ->with('success', 'You have successfully enrolled all the students from the file you imported!');
    }

    public function createByForm(Room $room)
    {
        return view('teachers.students.create-by-form', compact('room'));
    }

    public function storeByForm(Room $room)
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
