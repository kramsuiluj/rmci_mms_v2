<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\{
    AdminPanelController,
    AdminTeacherController,
    AdminStrandController,
    AdminGradeController,
    AdminSectionController,
    AdminRoomController,
    AdminSubjectController,
    AdminScheduleController,
    TeacherPasswordController,
    AdminStudentController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('home');

    Route::resource('teachers', AdminTeacherController::class)->except('show');

    Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
        Route::get('/{teacher}/change-password', [TeacherPasswordController::class, 'edit'])
            ->name('edit-password');
        Route::patch('/{teacher}/change', [TeacherPasswordController::class, 'update'])
            ->name('update-password');
    });

    Route::resource('strands', AdminStrandController::class);

    Route::group(['prefix' => 'strands'], function () {
        Route::group(['as' => 'grades.'], function () {
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

    Route::group(['prefix' => 'rooms', 'as' => 'schedules.'], function () {
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

    Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
        Route::get('/', [AdminStudentController::class, 'index'])->name('index');
    });
});

