<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TeacherPanelController,
    TeacherRoomController,
    TeacherStudentController,
    TeacherModuleController,
    TeacherScheduleController,
    TeacherNotificationController,
    TeacherCommentController,
    TeacherAssignmentController,
    TeacherAnswerController
};


Route::prefix('teacher')->as('teacher.')->group(function () {
    Route::get('/', [TeacherPanelController::class, 'index'])->name('index');
    Route::prefix('rooms')->group(function () {
        Route::get('/{room}', [TeacherRoomController::class, 'show'])->name('rooms.show');
        Route::as('students.')->group(function () {
            Route::middleware('adviser')->group(function () {
                Route::get('/{room}/students/enroll-by-file', [TeacherStudentController::class, 'createByFile'])
                    ->name('createByFile');
                Route::post('/{room}/students/file', [TeacherStudentController::class, 'storeByFile'])
                    ->name('storeByFile');
                Route::get('/{room}/students/enroll-by-form', [TeacherStudentController::class, 'createByForm'])
                    ->name('createByForm');
                Route::post('/{room}/students/form', [TeacherStudentController::class, 'storeByForm'])
                    ->name('storeByForm');
            });
            Route::delete('/students/{student}', [TeacherStudentController::class, 'destroy'])
                ->name('destroy');
        });
    });

    Route::get('/modules/scan', [TeacherModuleController::class, 'scan'])->name('modules.scan');
    Route::get('/modules/{module}/download', [TeacherModuleController::class, 'downloadModule'])
        ->name('modules.downloadModule');

    Route::prefix('schedules')->group(function () {
        Route::as('modules.')->group(function () {
            Route::get('/{schedule}/students/{student}/modules/generate', [TeacherModuleController::class, 'generate'])
                ->name('generate');
            Route::post('/{schedule}/students/{student}/modules/download', [TeacherModuleController::class, 'download'])
                ->name('download');
            Route::get('/{schedule}/modules', [TeacherModuleController::class, 'index'])
                ->name('index');
            Route::get('/{schedule}/students/{student}/modules/receive', [TeacherModuleController::class, 'receive'])
                ->name('receive');
            Route::post('/{schedule}/students/{students}/modules/record', [TeacherModuleController::class, 'record'])
                ->name('record');
            Route::get('/{schedule}/modules/upload', [TeacherModuleController::class, 'upload'])
                ->name('upload');
            Route::post('/{schedule}/modules/store', [TeacherModuleController::class, 'store'])
                ->name('store');
            Route::get('/{schedule}/students/modules', [TeacherModuleController::class, 'indexByStudent'])
                ->name('indexByStudent');
            Route::patch('/{schedule}/modules/{module}/check', [TeacherModuleController::class, 'check'])
                ->name('check');
            Route::get('/{schedule}/modules/{module}/comments', [TeacherModuleController::class, 'comment'])
                ->name('comment');
        });
        Route::post('/{schedule}/modules/{module}', [TeacherCommentController::class, 'store'])
            ->name('comments.store');
        Route::get('/{schedule}/students', [TeacherStudentController::class, 'indexBySchedule'])
            ->name('students.indexBySchedule');
        Route::get('/{schedule}/assignments/', [TeacherAssignmentController::class, 'index'])
            ->name('assignments.index');
        Route::get('/{schedule}/assignments/create', [TeacherAssignmentController::class, 'create'])
            ->name('assignments.create');
        Route::get('/{schedule}/assignments/{assignment}', [TeacherAssignmentController::class, 'show'])
            ->name('assignments.show');
        Route::get('/{schedule}/assignments/{assignment}/answers', [TeacherAnswerController::class, 'index'])
            ->name('answers.index');

        Route::post('/{schedule}/assignments', [TeacherAssignmentController::class, 'store'])
            ->name('assignments.store');
        Route::get('/{schedule}/assignments/{assignment}/answers/{answer}', [TeacherAnswerController::class, 'show'])
            ->name('answers.show');
        Route::patch('/{schedule}/assignments/{assignment}/answers/{answer}', [TeacherAnswerController::class, 'update'])
            ->name('answers.update');
    });
    Route::get('/subjects', [TeacherScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/notifications', [TeacherNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read', [TeacherNotificationController::class, 'read'])->name('notifications.read');

    Route::fallback(function () {
        return view('errors.404');
    });

    Route::get('/monitor', [TeacherModuleController::class, 'monitor'])->name('modules.monitor');
});
