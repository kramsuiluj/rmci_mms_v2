<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Module;
use App\Models\Schedule;
use App\Notifications\StudentCommented;
use Illuminate\Http\Request;

class StudentCommentController extends Controller
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

        $schedule->teacher->notify(new StudentCommented($comment, $schedule));

        return back();
    }
}
