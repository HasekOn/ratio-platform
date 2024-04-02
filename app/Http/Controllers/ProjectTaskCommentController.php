<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use App\Models\ProjectTaskComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectTaskCommentController extends Controller
{
    /**
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function store(ProjectTask $projectTask): RedirectResponse
    {
        $validated = $this->validation(\request());
        $validated['project_task_id'] = $projectTask->id;
        $validated['user_id'] = auth()->id();
        ProjectTaskComment::create($validated);

        return redirect()->route('projectTasks.show', $projectTask->id);
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
