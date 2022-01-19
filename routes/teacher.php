<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\{
    TeacherPanelController,
    TeacherRoomController,
    TeacherStudentController,
    TeacherModuleController,
    TeacherScheduleController,
    TeacherNotificationController,
    TeacherCommentController,
    TeacherAssignmentController,
    TeacherAnswerController,
    StudentFileEnrollmentController,
    StudentFormEnrollmentController,
    TeacherModuleGenerationController,
    TeacherModuleDownloadController,
    TeacherModuleSubmissionController,
    TeacherSubmittedModuleController,
};

Route::group(['prefix' => 'teacher', 'as' => 'teacher.'], function () {
    Route::get('/', [TeacherPanelController::class, 'index'])->name('index');

    Route::group(['prefix' => 'rooms'], function () {
        Route::get('/{room}', [TeacherRoomController::class, 'show'])->name('rooms.show');

        Route::group(['as' => 'students.'], function () {
            Route::group(['middleware' => 'adviser'], function () {
                Route::get('/{room}/students/enroll-by-file', [StudentFileEnrollmentController::class, 'create'])
                    ->name('createByFile');
                Route::post('/{room}/students/file', [StudentFileEnrollmentController::class, 'store'])
                    ->name('storeByFile');

                Route::get('/{room}/students/enroll-by-form', [StudentFormEnrollmentController::class, 'create'])
                    ->name('createByForm');
                Route::post('/{room}/students/form', [StudentFormEnrollmentController::class, 'store'])
                    ->name('storeByForm');
            });
            Route::delete('/students/{student}', [TeacherStudentController::class, 'destroy'])
                ->name('destroy');
        });
    });


    Route::group(['prefix' => 'schedules'], function () {
        Route::group(['as' => 'modules.'], function () {
            Route::get('/{schedule}/modules', [TeacherModuleController::class, 'index'])
                ->name('index');
            Route::get('/{schedule}/modules/upload', [TeacherModuleController::class, 'upload'])
                ->name('upload');
            Route::post('/{schedule}/modules/store', [TeacherModuleController::class, 'store'])
                ->name('store');

            Route::get('/{schedule}/students/{student}/modules/generate', [TeacherModuleGenerationController::class, 'create'])
                ->name('generate');
            Route::post('/{schedule}/students/{student}/modules/download', [TeacherModuleDownloadController::class, 'download'])
                ->name('download');

            Route::get('/{schedule}/students/{student}/modules/receive', [TeacherModuleSubmissionController::class, 'receive'])
                ->name('receive');
            Route::post('/{schedule}/students/{students}/modules/record', [TeacherModuleSubmissionController::class, 'record'])
                ->name('record');

            Route::get('/{schedule}/students/modules', [TeacherSubmittedModuleController::class, 'index'])
                ->name('indexByStudent');
            Route::patch('/{schedule}/modules/{module}/check', [TeacherSubmittedModuleController::class, 'check'])
                ->name('check');
            Route::get('/{schedule}/modules/{module}/comments', [TeacherSubmittedModuleController::class, 'comment'])
                ->name('comment');

            Route::get('/monitor', [TeacherModuleController::class, 'monitor'])->name('monitor');
            Route::get('/modules/scan', [TeacherModuleController::class, 'scan'])->name('scan');
            Route::get('/modules/{module}/download', [TeacherModuleController::class, 'downloadModule'])
                ->name('downloadModule');

            Route::delete('/{schedule}/modules/{module}/delete', [TeacherModuleController::class, 'destroy'])
                ->name('destroy');
        });
        Route::post('/{schedule}/modules/{module}', [TeacherCommentController::class, 'store'])
            ->name('comments.store');
        Route::get('/{schedule}/students', [TeacherStudentController::class, 'indexBySchedule'])
            ->name('students.indexBySchedule');

        Route::group(['as' => 'assignments.'], function () {
            Route::get('/{schedule}/assignments/', [TeacherAssignmentController::class, 'index'])
                ->name('index');
            Route::get('/{schedule}/assignments/create', [TeacherAssignmentController::class, 'create'])
                ->name('create');
            Route::get('/{schedule}/assignments/{assignment}', [TeacherAssignmentController::class, 'show'])
                ->name('show');
            Route::post('/{schedule}/assignments', [TeacherAssignmentController::class, 'store'])
                ->name('store');
        });

        Route::group(['as' => 'answers.'], function () {
            Route::get('/{schedule}/assignments/{assignment}/answers', [TeacherAnswerController::class, 'index'])
                ->name('index');
            Route::get('/{schedule}/assignments/{assignment}/answers/{answer}', [TeacherAnswerController::class, 'show'])
                ->name('show');
            Route::patch('/{schedule}/assignments/{assignment}/answers/{answer}', [TeacherAnswerController::class, 'update'])
                ->name('update');
        });
    });

    Route::get('/subjects', [TeacherScheduleController::class, 'index'])->name('schedules.index');

    Route::group(['as' => 'notifications.', 'prefix' => 'notifications'], function () {
        Route::get('/', [TeacherNotificationController::class, 'index'])->name('index');
        Route::get('/read', [TeacherNotificationController::class, 'read'])->name('read');
    });

    Route::fallback(function () {
        return view('errors.404');
    });
});
