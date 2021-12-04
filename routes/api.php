<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Module;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('chart', function () {
    $module = Module::where('schedule_id', 1)->where('user_id', '<>', 2)->get();
    $students = \App\Models\StudentProfile::all();

    return response()->json([$module->count(), $students->count()]);
})->name('api.chart');

Route::get('/schedules/{schedule}/modules', function ($schedule) {
    $modules = Module::where('schedule_id', $schedule)->where('is_displayed', NULL)->get()->count();

    return response()->json([$modules]);
})->name('api.modules');
