<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTaskComment\CreateProjectTaskCommentRequest;
use App\Models\ProjectTask;
use App\Models\ProjectTaskComment;
use Illuminate\Http\RedirectResponse;

class ProjectTaskCommentController extends Controller
{
    /**
     * @param CreateProjectTaskCommentRequest $request
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function store(CreateProjectTaskCommentRequest $request, ProjectTask $projectTask): RedirectResponse
    {
        $validated = $request->validated();
        $validated['project_task_id'] = $projectTask->id;
        $validated['user_id'] = auth()->id();
        ProjectTaskComment::create($validated);

        return redirect()->route('projectTasks.show', $projectTask->id);
    }
}
