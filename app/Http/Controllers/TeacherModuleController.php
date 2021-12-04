<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Module;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\CheckModule;
use App\Notifications\ModuleUploaded;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\AssignOp\Mod;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

require_once 'C:\Mark\laravel\rmci_mms_v2\vendor\autoload.php';

class TeacherModuleController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('teachers.modules.index', [
            'modules' => Module::where('user_id', auth()->user()->id)
                ->where('schedule_id', $schedule->id)->get()
        ]);
    }

    public function indexByStudent(Schedule $schedule)
    {
        return view('teachers.modules.index-by-student', [
            'modules' => Module::where('user_id', '<>', auth()->user()->id)
                ->where('schedule_id', $schedule->id)->get(),
            'schedule' => $schedule
        ]);
    }

    public function comment(Schedule $schedule, Module $module)
    {
        return view('teachers.modules.show', [
            'schedule' => $schedule,
            'module' => $module,
            'comments' => Comment::where('module_id', $module->id)->get()
        ]);
    }

    public function generate(Schedule $schedule, User $student)
    {
        return view('teachers.modules.generate', compact('schedule', 'student'));
    }

    public function download(Schedule $schedule, User $student)
    {
        $file = request()->validate([
            'module' => ['required', 'mimes:docx,doc', 'max:10240']
        ]);
        $filename = $student->id . '-' . $student->lastname . '-' . $file['module']->getClientOriginalName();

        $qrcode_path = $this->generateQrCode($schedule->id, $student->id);

        $path = 'app/' . $file['module']->storeAs('modules', $filename);
        $full_path = str_replace('/', '\\', $path);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle($fontStyleName, array('name' => 'Century Gothic', 'size' => 16, 'color' => 'FFFFF', 'bold' => true));
        $document = $phpWord->loadTemplate(storage_path($full_path));
        $document->setValues(
            array(
                'strand' => strtoupper($student->profile->room->strand->name),
                'section' => strtoupper($student->profile->room->section->gradeAndSection()),
                'fullname' => $student->fullname()
            ));
        $document->setImageValue('qrcode', $qrcode_path);
        $document->saveAs(storage_path($full_path));

        $module = Module::create([
            'user_id' => auth()->user()->id,
            'schedule_id' => $schedule->id,
            'module' => $full_path,
            'is_displayed' => false
        ]);

        $module->addMedia(storage_path($full_path))->toMediaCollection();

        return $module->getFirstMedia();
    }

    public function scan()
    {
        return view('teachers.modules.scan');
    }

    public function receive(Schedule $schedule, User $student)
    {
        return view('teachers.modules.receive', compact('schedule', 'student'));
    }

    public function record()
    {
        $attributes = request()->validate([
            'user_id' => [
                'required',
                Rule::exists('users', 'id')
            ],
            'schedule_id' => [
                'required',
                Rule::exists('schedules', 'id')
                    ->where('teacher_id', auth()->user()->id),
            ],
            'status' => [
                'required',
                'boolean'
            ]
        ]);

        Module::create($attributes);

        return redirect(route('teacher.index'))
            ->with('success', 'You have successfully recorded a module!');
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

        $module = Module::create($attributes);
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

    public function check(Schedule $schedule, Module $module)
    {
        $module->update(['status' => true]);

        $module->user->profile->notify(new CheckModule($module));

        return back()->with('success', 'You have checked a module successfully!');
    }

    protected function generateQrCode($schedule, $student): string
    {
        (string)QrCode::format('png')
            ->color(37, 99, 235)
            ->margin(0)
            ->size(400)
            ->generate(route('teacher.modules.receive', [$schedule, $student]), storage_path('app/public/qrcodes/' . $student . '.png'));

        return storage_path('app/public/qrcodes/' . $student . '.png');
    }


}
