<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTask\CreateProjectTaskRequest;
use App\Http\Requests\ProjectTask\UpdateProjectTaskRequest;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{

    public function show(ProjectTask $projectTask)
    {
        return view('pages.projectTask-show', compact('projectTask'));
    }

    public function edit(ProjectTask $projectTask)
    {
        $editing = true;
        return view('pages.projectTask-show', compact('projectTask', 'editing'));
    }

    /**
     * @param UpdateProjectTaskRequest $request
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function update(UpdateProjectTaskRequest $request, ProjectTask $projectTask): RedirectResponse
    {
        $validated = $request->validated();
        $validated['project_id'] = $projectTask->project_id;
        $validated['user_id'] = $projectTask->user_id;
        $projectTask->update($validated);

        return redirect()->route('projectTasks.show', $projectTask['id']);
    }

    /**
     * @param CreateProjectTaskRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function store(CreateProjectTaskRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();
        $validated['project_id'] = $project->id;
        $validated['user_id'] = auth()->id();
        ProjectTask::create($validated);

        return redirect()->route('projects.show', $project->id);
    }

    /**
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function destroy(ProjectTask $projectTask): RedirectResponse
    {
        $projectTask->delete();

        return redirect()->route('projects.show', $projectTask['project_id']);
    }
}
