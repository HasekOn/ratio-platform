<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

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
        $validated['user_id'] = auth()->id();
        Comment::create($validated);

        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * @param Task $task
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Task $task, Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('tasks.show', $task->id);
    }
}
