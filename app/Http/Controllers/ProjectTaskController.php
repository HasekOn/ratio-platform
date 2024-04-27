<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTask\CreateProjectTaskRequest;
use App\Http\Requests\ProjectTask\UpdateProjectTaskRequest;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\UserProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProjectTaskController extends Controller
{

    public function show(ProjectTask $projectTask)
    {
        return view('pages.projectTask-show', compact('projectTask'))->render();
    }

    public function edit(ProjectTask $projectTask)
    {
        $editing = true;
        $usersProject = UserProject::where('project_id', $projectTask->project_id)->get();
        $projects = Project::where('id', $projectTask->project_id)->get();

        return view('pages.projectTask-show', compact('projectTask', 'editing', 'usersProject', 'projects'));
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
        $validated['assignee'] = $request->input('assignee');
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
        $validated['assignee'] = $request->input('assignee');
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

    /**
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function assigneeToProject(ProjectTask $projectTask): RedirectResponse
    {
        $validated = request()->all();
        $validated['project_id'] = $projectTask->project_id;
        $validated['user_id'] = $projectTask->user_id;
        $validated['assignee'] = Auth::id();
        $projectTask->update($validated);

        return redirect()->route('projectTasks.show', $projectTask['id']);
    }

    /**
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function unassignToProject(ProjectTask $projectTask): RedirectResponse
    {
        $validated = request()->all();
        $validated['project_id'] = $projectTask->project_id;
        $validated['user_id'] = $projectTask->user_id;
        $validated['assignee'] = null;
        $projectTask->update($validated);

        return redirect()->route('projectTasks.show', $projectTask['id']);
    }
}
