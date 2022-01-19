<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Room;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class StudentFileEnrollmentController extends Controller
{
    public function create(Room $room)
    {
        return view('teachers.students.create-by-file', compact('room'));
    }

    public function store(Room $room)
    {
        $attributes = request()->validate([
            'students' => ['required', 'mimes:csv,xlsx', 'max:10240']
        ]);

        $students = Excel::toArray(new StudentImport(), $attributes['students']);

        $insertedStudents = [];

        for ($i = 0; $i < count($students); $i++) {
            $student = $students[$i];
            for ($j = 0; $j < count($student); $j++) {
                try {
                    $user = User::create([
                        'id' => $student[$j]['id'],
                        'username' => $student[$j]['username'],
                        'firstname' => $student[$j]['firstname'],
                        'middlename' => $student[$j]['middlename'],
                        'lastname' => $student[$j]['lastname'],
                        'password' => bcrypt($student[$j]['password'])
                    ]);

                    $insertedStudents[] = $student[$j]['id'];
                } catch (QueryException $e) {
                    $firstname = $student[$j]['firstname'];
                    $lastname = $student[$j]['lastname'];

                    foreach ($insertedStudents as $student) {
                        $user = User::find($student);
                        $user->profile->delete();
                        $user->delete();
                    }

                    throw ValidationException::withMessages([
                        'students' => $firstname . ' ' . $lastname . ' might already been enrolled or some of the data must have duplicate.'
                    ]);
                } catch (\ErrorException $e) {
                    throw ValidationException::withMessages([
                        'students' => 'The file you uploaded is missing a column.'
                    ]);
                }

                $profile = StudentProfile::create([
                    'room_id' => $room->id,
                    'contact' => $student[$j]['contact'],
                    'is_active' => false
                ]);

                $profile->user()->save(User::find($user->id));
            }
        }

        return redirect(route('teacher.index'))
            ->with('success', 'You have successfully enrolled all the students from the file you imported!');

//        array_map(function ($student) use ($insertedStudents, $room) {
//            array_map(function ($s) use ($insertedStudents, $room) {
//                try {
//                    $user = User::create([
//                        'id' => $s['id'],
//                        'username' => $s['username'],
//                        'firstname' => $s['firstname'],
//                        'middlename' => $s['middlename'],
//                        'lastname' => $s['lastname'],
//                        'password' => bcrypt($s['password'])
//                    ]);
//
//                    $insertedStudents[] = $s['id'];
//                } catch (QueryException $e) {
//                    throw ValidationException::withMessages([
//                        'students' => $s['firstname'] . ' ' . $s['lastname'] . ' might already been enrolled or some of the data must have duplicate.'
//                    ]);
//                }
//
//                $profile = StudentProfile::create([
//                    'room_id' => $room->id,
//                    'contact' => $s['contact'],
//                    'is_active' => false
//                ]);
//
//                $profile->user()->save(User::find($user->id));
//            }, $student);
//        }, $students);

//        return redirect(route('teacher.index'))
//            ->with('success', 'You have successfully enrolled all the students from the file you imported!');
    }

}
