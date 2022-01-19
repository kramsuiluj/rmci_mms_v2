<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Room;
use App\Models\Strand;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminRoomController extends Controller
{
    public function index()
    {
        return view('administrator.rooms.index', [
            'rooms' => Room::all()
        ]);
    }

    public function create()
    {
        return view('administrator.rooms.create', [
            'advisers' => TeacherProfile::where('is_adviser', 0)->with('user')->get(),
            'strands' => Strand::all(),
            'currentStrand' => Strand::firstWhere('name', request('strand')),
            'currentGrade' => Grade::firstWhere('name', request('grade'))
        ]);
    }

    public function store()
    {
        $attributes = $this->validateRoom();

        Room::create($attributes);
        $teacher = User::find($attributes['adviser_id']);
        $teacher->profile->update(['is_adviser' => true]);

        return redirect(route('admin.rooms.index'))
            ->with('success', 'You have successfully created a class.');
    }

    public function edit(Room $room)
    {
        return view('administrator.rooms.edit', [
            'currentRoom' => $room,
            'strands' => Strand::all(),
            'advisers' => TeacherProfile::where('is_adviser', 0)->with('user')->get(),
            'currentStrand' => Strand::firstWhere('name', request('strand')),
            'currentGrade' => Grade::firstWhere('name', request('grade'))
        ]);
    }

    public function update(Room $room)
    {
        $attributes = $this->validateRoom($room);
        $update = [];

        if ($room->adviser_id !== (int)$attributes['adviser_id']) {
            $update['adviser_id'] = $attributes['adviser_id'];
        }

        if ($room->strand_id !== (int)$attributes['strand_id']) {
            $update['strand_id'] = $attributes['strand_id'];
        }

        if ($room->grade_id !== (int)$attributes['grade_id']) {
            $update['grade_id'] = $attributes['grade_id'];
        }

        if ($room->section_id !== (int)$attributes['section_id']) {
            $update['section_id'] = $attributes['section_id'];
        }

        if ($room->semester !== $attributes['semester']) {
            $update['semester'] = $attributes['semester'];
        }

        if (!empty($update)) {
            if ($update['adviser_id'] ?? false) {
                $currentAdviser = User::find($room->adviser_id)->profile;
                $newAdviser = User::find($update['adviser_id'])->profile;

                $currentAdviser->update(['is_adviser' => false]);
                $newAdviser->update(['is_adviser' => true]);
            }

            $room->update($update);

            return redirect(route('admin.rooms.index'))
                ->with('success', 'You have successfully updated the class you selected!');
        } else {
            return redirect(route('admin.rooms.index'))
                ->with('info', 'You did not update any field.');
        }
    }

    public function destroy(Room $room)
    {
        $students = $room->students;

        foreach($students as $student) {
            if ($student->notifications()) {
                $student->notifications()->delete();
            }

            if ($student->user->modules) {
                foreach($student->user->modules as $module) {
                    if ($module->getFirstMedia()) {
                        $module->getFirstMedia()->delete();
                        $module->delete();
                    } else {
                        $module->delete();
                    }
                }
            }
            $student->user->delete();
        }

        User::find($room->adviser_id)->profile->update(['is_adviser' => false]);

        $room->delete();

        return redirect(route('admin.rooms.index'))
            ->with('success', 'You have successfully delete the room you selected!');
    }

    protected function validateRoom($room = ''): array
    {
        return request()->validate([
            'adviser_id' => [
                'required', 'numeric',
                Rule::exists('users', 'id'),
                Rule::unique('rooms', 'adviser_id')
                    ->ignore($room)
            ],
            'strand_id' => [
                'required',
                Rule::exists('strands', 'id')
            ],
            'grade_id' => [
                'required',
                Rule::exists('grades', 'id')
            ],
            'section_id' => [
                'required',
                Rule::exists('sections', 'id'),
                Rule::unique('rooms', 'section_id')
                    ->ignore($room)
            ],
            'semester' => [
                'required'
            ]
        ]);
    }
}
