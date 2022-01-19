<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Module;
use App\Models\Schedule;
use App\Notifications\SubmitModule;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

require_once 'C:\Mark\laravel\rmci_mms_v2\vendor\autoload.php';

class StudentModuleController extends Controller
{
    public function index(Schedule $schedule)
    {
        return view('students.modules.index', [
            'schedule' => $schedule,
            'modules' => Module::where('schedule_id', $schedule->id)->where('is_displayed', 1)->get()
        ]);
    }

    public function show(Schedule $schedule, Module $module)
    {
        return view('students.modules.show', [
            'schedule' => $schedule,
            'module' => $module,
            'comments' => Comment::where('module_id', $module->id)->get()
        ]);
    }

    public function submitted(Schedule $schedule)
    {
        return view('students.modules.submitted', [
            'schedule' => $schedule,
            'modules' => Module::where('user_id', auth()->user()->id)
                ->where('schedule_id', $schedule->id)->get()
        ]);
    }

    public function download(Schedule $schedule, Module $module): ?Media
    {
        $qrcode_path = $this->generateQrCode($schedule->id, auth()->user()->id);
        $filename = auth()->user()->id . '-' . auth()->user()->lastname . '-' . $module->getFirstMedia()->file_name;

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle($fontStyleName, array('name' => 'Century Gothic', 'size' => 16, 'color' => 'FFFFF', 'bold' => true));
        $document = $phpWord->loadTemplate($module->getFirstMediaPath());
        $document->setValues(
            array(
                'strand' => strtoupper(auth()->user()->profile->room->strand->name),
                'section' => strtoupper(auth()->user()->profile->room->section->gradeAndSection()),
                'fullname' => auth()->user()->fullname()
            ));
        $document->setImageValue('qrcode', $qrcode_path);
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $document->saveAs($temp_file);

        header("Content-Disposition: attachment; filename=" . $filename);
        readfile($temp_file);
        unlink($temp_file);
    }

    public function create(Schedule $schedule)
    {
        return view('students.modules.create', compact('schedule'));
    }

    public function store(Schedule $schedule)
    {
        $attributes = request()->validate([
            'user_id' => [
                'required',
            ],
            'schedule_id' => [
                'required',
            ],
            'module' => [
                'required',
                'mimes:docx, pdf',
                'max:10240'
            ],
            'status' => [
                'required',
                'boolean'
            ]
        ]);

        $attributes['filename'] = request('module')->getClientOriginalName();

        try {
            $module = Module::create($attributes);
        } catch (QueryException $e) {
            throw ValidationException::withMessages([
                'filename' => 'You have already submitted a module with similar filename.'
            ]);
        }

        $module->addMedia($attributes['module'])->toMediaCollection();

        $schedule->teacher->notify(new SubmitModule($module));

        return redirect(route('student.modules.submitted', $schedule->id))
            ->with('success', 'You have successfully uploaded a module for ' . $schedule->subject->name);
    }

    public function destroy(Schedule $schedule, Module $module)
    {
        $module->getFirstMedia()->delete();
        $module->delete();

        return redirect(route('student.modules.submitted', $schedule->id))
            ->with('success', 'You have successfully removed the module you selected!');
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
