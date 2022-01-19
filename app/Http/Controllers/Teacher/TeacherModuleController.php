<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Room;
use App\Models\Schedule;
use App\Notifications\ModuleUploaded;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

//require_once 'C:\Mark\laravel\rmci_mms_v2\vendor\autoload.php';

class TeacherModuleController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('teachers.modules.index', [
            'modules' => Module::where('user_id', auth()->user()->id)
                ->where('schedule_id', $schedule->id)->get(),
            'schedule' => $schedule
        ]);
    }

    public function scan()
    {
        return view('teachers.modules.scan');
    }

    public function upload(Schedule $schedule)
    {
        return view('teachers.modules.upload', compact('schedule'));
    }

    public function store(Schedule $schedule)
    {
        $attributes = request()->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')
            ],
            'schedule_id' => [
                'required',
                Rule::exists('schedules', 'id')
            ],
            'module' => [
                'required',
                'mimes:docx,doc',
                'max:10240'
            ],
            'status' => [
                'required',
                'boolean'
            ],
            'is_displayed' => [
                'required',
                'boolean'
            ]
        ]);


        $attributes['filename'] = request('module')->getClientOriginalName();

        try {
            $module = Module::create($attributes);
        } catch (QueryException $e) {
            throw ValidationException::withMessages([
                'filename' => 'You have already uploaded a module with similar filename.'
            ]);

        }

        $module->addMedia($attributes['module'])->toMediaCollection();

        $students = Room::find($schedule->room_id)->students;

        Notification::sendNow($students, new ModuleUploaded($module));

        return redirect(route('teacher.schedules.index'))
            ->with('success', 'You have successfully uploaded a module!');
    }

    public function monitor()
    {
        $schedules = Schedule::where('teacher_id', auth()->user()->id)->get();

        if (request('schedule') ?? false) {
            $currentSchedule = Schedule::latest()->filter(request(['schedule']))->first();

            $modules = Module::query()
                ->where('schedule_id', $currentSchedule->id)
                ->whereHas('user', function ($query) {
                    $query->where('profile_type', 'App\Models\StudentProfile');
                })->distinct()->count('user_id');

            $students = $currentSchedule->room->students->count();
        }

        $moduleDates = Module::where('schedule_id', request('schedule'))->where('is_displayed', NULL)->get()->toArray();

        $dates = array_map(function ($date) {
            return date("F d, Y", strtotime($date['created_at']));
        }, $moduleDates);

        $moduleCount = DB::table('modules')
            ->select(array(DB::raw('DATE(modules.created_at)')))
            ->groupBy('modules.created_at')
            ->orderBy('modules.created_at')
            ->get();

        return view('teachers.modules.monitor', [
            'schedules' => $schedules,
            'currentSchedule' => $currentSchedule ?? null,
            'modules' => $modules ?? null,
            'students' => $students ?? null,
            'moduleDates' => $moduleDates ?? null,
            'dates' => $dates ?? null,
            'moduleCount' => $moduleCount ?? null,
        ]);
    }

    public function downloadModule(Module $module): ?Media
    {
        return $module->getFirstMedia();
    }

    public function destroy(Schedule $schedule, Module $module)
    {
        $module->getFirstMedia()->delete();
        $module->delete();

        return redirect(route('teacher.modules.index', $schedule->id))
            ->with('success', 'You have successfully removed the module you selected!');
    }

}
