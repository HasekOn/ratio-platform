<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Task $task)
    {
        $validated = $this->validation(\request());
        $validated['task_id'] = $task->id;
        Comment::create($validated);

        return redirect()->route('tasks.show', $task->id);
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'content' => 'min:1|max:500',
        ]);
    }
}
