<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Schedule;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TeacherModuleDownloadController extends Controller
{
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
                'subject' => strtoupper($schedule->subject->name),
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

    protected function generateQrCode($schedule, $student): string
    {
        (string)QrCode::format('png')
            ->color(37, 99, 235)
            ->margin(0)
            ->size(400)
            ->merge('\public\images\rmci-logo-wbg.png', .3)
            ->generate(route('teacher.modules.receive', [$schedule, $student]), storage_path('app/public/qrcodes/' . $student . '.png'));

        return storage_path('app/public/qrcodes/' . $student . '.png');
    }

}
