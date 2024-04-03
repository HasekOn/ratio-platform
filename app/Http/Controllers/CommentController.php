<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param CreateCommentRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function store(CreateCommentRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();
        $validated['task_id'] = $task->id;
        Comment::create($validated);

        return redirect()->route('tasks.show', $task->id);
    }
}
