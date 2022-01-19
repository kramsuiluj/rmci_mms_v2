<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Models\Room;
use Illuminate\Validation\Rule;

class AdminScheduleController extends Controller
{
    public function index(Room $room)
    {
        return view('administrator.schedules.index', compact('room'));
    }

    public function create(Room $room)
    {
        return view('administrator.schedules.create', [
            'room' => $room,
            'subjects' => Subject::all(),
            'teachers' => User::where('profile_type', 'App\Models\TeacherProfile')->get()
        ]);
    }

    public function store()
    {
        Schedule::create($this->validateSchedule());

        return redirect(route('admin.rooms.index'))
            ->with('success', 'You have successfully added a schedule to the class you selected!');
    }

    public function edit(Room $room, Schedule $schedule)
    {
        return view('administrator.schedules.edit', [
            'room' => $room,
            'schedule' => $schedule,
            'subjects' => Subject::all(),
            'teachers' => User::where('profile_type', 'App\Models\TeacherProfile')->get()
        ]);
    }

    public function update(Room $room, Schedule $schedule)
    {
        $attributes = $this->validateSchedule($schedule->subject_id);
        $update = [];

        if ($schedule->room_id !== (int)$attributes['room_id']) {
            $update['room_id'] = $attributes['room_id'];
        }

        if ($schedule->subject_id !== (int)$attributes['subject_id']) {
            $update['subject_id'] = $attributes['subject_id'];
        }

        if ($schedule->teacher_id !== (int)$attributes['teacher_id']) {
            $update['teacher_id'] = $attributes['teacher_id'];
        }

        if (!empty($update)) {
            $schedule->update($update);

            return redirect(route('admin.schedules.index', $room->id))
                ->with('success', 'You have successfully update the schedule you selected!');
        } else {
            return redirect(route('admin.schedules.index', $room->id))
                ->with('info', 'You did not update any field.');
        }
    }

    public function destroy(Room $room, Schedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'You have successfully deleted the schedule you selected!');
    }

    protected function validateSchedule($schedule = ''): array
    {
        return request()->validate([
            'room_id' => [
                'required',
                Rule::exists('rooms', 'id'),
                Rule::unique('schedules')
                    ->where('room_id', request('room_id'))
                    ->where('subject_id', request('subject_id'))
                    ->where('teacher_id', request('teacher_id'))
                    ->ignore($schedule)
            ],
            'subject_id' => [
                'required',
                Rule::exists('subjects', 'id'),
                Rule::unique('schedules')
                    ->where('room_id', request('room_id'))
                    ->where('subject_id', request('subject_id'))
                    ->where('teacher_id', request('teacher_id'))
                    ->ignore($schedule)
            ],
            'teacher_id' => [
                'required',
                Rule::exists('users', 'id'),
                Rule::unique('schedules')
                    ->where('room_id', request('room_id'))
                    ->where('subject_id', request('subject_id'))
                    ->where('teacher_id', request('teacher_id'))
                    ->ignore($schedule)
            ]
        ]);
    }
}
