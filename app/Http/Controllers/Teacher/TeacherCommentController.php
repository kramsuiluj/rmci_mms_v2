<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Module;
use App\Models\Schedule;
use App\Notifications\TeacherCommented;
use Illuminate\Http\Request;

class TeacherCommentController extends Controller
{
    public function store(Schedule $schedule, Module $module)
    {
        $attribute = request()->validate([
            'body' => 'required'
        ]);

        $comment = Comment::create([
            'module_id' => $module->id,
            'user_id' => auth()->user()->id,
            'body' => $attribute['body']
        ]);

        $module->user->profile->notify(new TeacherCommented($comment, $schedule, $module));

        return back();
    }
}
