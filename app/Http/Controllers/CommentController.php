<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Task $task
     * @return RedirectResponse
     */
    public function store(Task $task): RedirectResponse
    {
        $validated = $this->validation(\request());
        $validated['task_id'] = $task->id;
        Comment::create($validated);

        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validation(Request $request): array
    {
        return $request->validate([
            'content' => 'min:1|max:500',
        ]);
    }
}
