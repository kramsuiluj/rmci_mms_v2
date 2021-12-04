<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    StudentPanelController,
    StudentRoomController,
    StudentModuleController,
    StudentNotificationController,
    StudentCommentController,
    StudentAssignmentController,
    StudentAnswerController
};


Route::prefix('student')->as('student.')->group(function () {
    Route::get('/', [StudentPanelController::class, 'index'])->name('index');
    Route::get('/rooms/{room:section_id}', [StudentRoomController::class, 'show'])->name('rooms.show');
    Route::get('/schedules/{schedule}/modules', [StudentModuleController::class, 'index'])->name('modules.index');
    Route::get('/schedules/{schedule}/modules/upload', [StudentModuleController::class, 'create'])
        ->name('modules.create');
    Route::get('/schedules/{schedule}/modules/{module}', [StudentModuleController::class, 'download'])
        ->name('modules.download');
    Route::post('/schedules/{schedule}/modules', [StudentModuleController::class, 'store'])->name('modules.store');
    Route::get('/schedules/{schedule}/submitted-modules', [StudentModuleController::class, 'submitted'])
        ->name('modules.submitted');
    Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read', [StudentNotificationController::class, 'read'])->name('notifications.read');
    Route::get('/schedules/{schedule}/modules/{module}/comments', [StudentModuleController::class, 'show'])
        ->name('modules.show');
    Route::post('/schedules/{schedule}/modules/{module}', [StudentCommentController::class, 'store'])
        ->name('comments.store');
    Route::get('/schedules/{schedule}/assignments', [StudentAssignmentController::class, 'index'])
        ->name('assignments.index');
    Route::get('/schedules/{schedule}/assignments/{assignment}', [StudentAssignmentController::class, 'show'])
        ->name('assignments.show');
    Route::post('/schedules/{schedule}/assignments/{assignment}', [StudentAnswerController::class, 'store'])
        ->name('answers.store');
    Route::get('/schedules/{schedule}/assignments/{assignment}/answers/{answer}/edit', [StudentAnswerController::class, 'edit'])
        ->name('answers.edit');
    Route::patch('/schedules/{schedule}/assignments/{assignment}/answers/{answer}', [StudentAnswerController::class, 'update'])->name('answers.update');
    Route::delete('/schedules/{schedule}/assignments/{assignment}/answers/{answer}', [StudentAnswerController::class, 'destroy'])->name('answers.destroy');
});
