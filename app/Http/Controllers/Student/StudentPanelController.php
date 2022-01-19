<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Module;

class StudentPanelController extends Controller
{
    public function index()
    {
        $latestModule = Module::query()
            ->where('is_displayed', 1)
            ->whereHas('schedule', function ($query) {
                $query->whereHas('room', function ($query) {
                    $query->where('id', auth()->user()->profile->room->id);
                });
            })->latest()->first();

        $latestAssignment = Assignment::query()
            ->whereHas('schedule', function ($query) {
                $query->whereHas('room', function ($query) {
                    $query->where('id', auth()->user()->profile->room->id);
                });
            })->latest()->first();

        return view('students.index', compact('latestModule', 'latestAssignment'));
    }
}
