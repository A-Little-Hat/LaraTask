<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add($task_id,Request $request)
    {
        $user = Auth::user(); 
        $comment = new Comment();
        $comment->id = $user->id;
        $comment->author = $user->name;
        $comment->task_id = $task_id;
        $comment->body = $request->input('body');
        $comment->save();
        return redirect('/tasks/view/'.$task_id)->with('success', 'Task created successfully!');
    }
}
