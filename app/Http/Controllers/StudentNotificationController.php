<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentNotificationController extends Controller
{
    public function index()
    {
//        dd(\App\Models\Module::firstWhere('id', 27)->id);

        return view('students.notifications.index', [
            'notifications' => auth()->user()->profile->unreadNotifications
        ]);
    }

    public function read()
    {
        auth()->user()->profile->unreadNotifications->markAsRead();

        return back()->with('info', 'All notifications has been marked as read.');
    }
}
