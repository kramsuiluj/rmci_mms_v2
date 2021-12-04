<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminPanelController,
    AdminTeacherController,
    AdminStrandController,
    AdminGradeController,
    AdminSectionController,
    AdminRoomController,
    AdminSubjectController,
    AdminScheduleController
};


Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('home');

    Route::resource('teachers', AdminTeacherController::class)->except('show');

    Route::prefix('teachers')->as('teachers.')->group(function () {
        Route::get('/{teacher}/change-password', [AdminTeacherController::class, 'editPassword'])
            ->name('edit-password');
        Route::patch('/{teacher}/change', [AdminTeacherController::class, 'updatePassword'])
            ->name('update-password');
    });

    Route::resource('strands', AdminStrandController::class);

    Route::prefix('strands')->group(function () {
        Route::as('grades.')->group(function () {
            Route::get('/{strand}/add-grade', [AdminGradeController::class, 'create'])
                ->name('create');
            Route::post('/{strand}/add', [AdminGradeController::class, 'store'])
                ->name('store');
            Route::get('/{strand}/grades', [AdminGradeController::class, 'index'])
                ->name('index');
            Route::get('/{strand}/grades/{grade}', [AdminGradeController::class, 'show'])
                ->name('show');
            Route::delete('/{strand}/grades/{grade}', [AdminGradeController::class, 'destroy'])
                ->name('destroy');
        });

        Route::as('sections.')->group(function () {
            Route::get('/{strand}/add-section', [AdminSectionController::class, 'create'])
                ->name('create');
            Route::post('/{strand}/sections', [AdminSectionController::class, 'store'])
                ->name('store');
            Route::get('/{strand}/sections', [AdminSectionController::class, 'index'])
                ->name('index');
            Route::get('/{strand}/sections/{section}', [AdminSectionController::class, 'show'])
                ->name('show');
            Route::get('/{strand}/sections/{section}/edit', [AdminSectionController::class, 'edit'])
                ->name('edit');
            Route::patch('/{strand}/sections/{section}', [AdminSectionController::class, 'update'])
                ->name('update');
            Route::delete('/{strand}/sections/{section}', [AdminSectionController::class, 'destroy'])
                ->name('destroy');
        });
    });
    Route::resource('rooms', AdminRoomController::class)->except('show');

    Route::resource('subjects', AdminSubjectController::class)->except('show');

    Route::prefix('rooms')->as('schedules.')->group(function () {
        Route::get('/{room}/schedules', [AdminScheduleController::class, 'index'])
            ->name('index');
        Route::get('/{room}/schedules/create', [AdminScheduleController::class, 'create'])
            ->name('create');
        Route::post('/{room}/schedules', [AdminScheduleController::class, 'store'])
            ->name('store');
        Route::get('/{room}/schedules/{schedule}/edit', [AdminScheduleController::class, 'edit'])
            ->name('edit');
        Route::patch('/{room}/schedules/{schedule}', [AdminScheduleController::class, 'update'])
            ->name('update');
        Route::delete('/{room}/schedules/{schedule}', [AdminScheduleController::class, 'destroy'])
            ->name('destroy');
    });
});

