<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherNotificationController extends Controller
{
    public function index()
    {
        return view('teachers.notifications.index', [
            'notifications' => auth()->user()->unreadNotifications
        ]);
    }

    public function read()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('info', 'All notifications has been marked as read.');
    }
}
