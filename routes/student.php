<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\{
    StudentPanelController,
    StudentRoomController,
    StudentModuleController,
    StudentNotificationController,
    StudentCommentController,
    StudentAssignmentController,
    StudentAnswerController,
    StudentReportController,
    StudentPasswordController
};

Route::group(['as' => 'student.'], function () {
    Route::get('/students/{student}/change-password', [StudentPasswordController::class, 'edit'])->name('edit');
    Route::patch('/students/{student}', [StudentPasswordController::class, 'update'])->name('update');

    Route::group(['prefix' => 'student', 'middleware' => 'active'], function () {
        Route::get('/', [StudentPanelController::class, 'index'])->name('index');
        Route::get('/reports', [StudentReportController::class, 'index'])->name('reports.index');
        Route::get('/rooms/{room:section_id}', [StudentRoomController::class, 'show'])->name('rooms.show');

        Route::group(['prefix' => 'schedules'], function () {
            Route::group(['as' => 'modules.'], function () {
                Route::get('/{schedule}/modules', [StudentModuleController::class, 'index'])->name('index');
                Route::get('/{schedule}/modules/upload', [StudentModuleController::class, 'create'])
                    ->name('create');
                Route::get('/{schedule}/modules/{module}', [StudentModuleController::class, 'download'])
                    ->name('download');
                Route::post('/{schedule}/modules', [StudentModuleController::class, 'store'])->name('store');
                Route::get('/{schedule}/submitted-modules', [StudentModuleController::class, 'submitted'])
                    ->name('submitted');
                Route::get('/{schedule}/modules/{module}/comments', [StudentModuleController::class, 'show'])
                    ->name('show');
                Route::delete('/{schedule}/modules/{module}/delete', [StudentModuleController::class, 'destroy'])
                    ->name('destroy');
            });

            Route::post('/{schedule}/modules/{module}', [StudentCommentController::class, 'store'])
                ->name('comments.store');

            Route::group(['as' => 'assignments.'], function () {
                Route::get('/{schedule}/assignments', [StudentAssignmentController::class, 'index'])
                    ->name('index');
                Route::get('/{schedule}/assignments/{assignment}', [StudentAssignmentController::class, 'show'])
                    ->name('show');
            });

            Route::group(['as' => 'answers.'], function () {
                Route::post('/{schedule}/assignments/{assignment}', [StudentAnswerController::class, 'store'])
                    ->name('store');
                Route::get('/{schedule}/assignments/{assignment}/answers/{answer}/edit', [StudentAnswerController::class, 'edit'])
                    ->name('edit');
                Route::patch('/{schedule}/assignments/{assignment}/answers/{answer}', [StudentAnswerController::class, 'update'])->name('update');
                Route::delete('/{schedule}/assignments/{assignment}/answers/{answer}', [StudentAnswerController::class, 'destroy'])->name('destroy');
            });
        });

        Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/read', [StudentNotificationController::class, 'read'])->name('notifications.read');
    });
});
