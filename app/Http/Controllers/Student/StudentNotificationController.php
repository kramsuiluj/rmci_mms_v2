<?php

namespace App\Http\Controllers\Student;


use App\Http\Controllers\Controller;

class StudentNotificationController extends Controller
{
    public function index()
    {
//        $unreadNotifications = auth()->user()->profile->unreadNotifications;
//
//        $notifications = $unreadNotifications->map(function ($notification) {
//            $notification->schedule;
//            return $notification;
//        });
//
//        dd($notifications);

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
