<?php

namespace App\Http\Controllers;

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
     * @param ProjectTask $projectTask
     * @return RedirectResponse
     */
    public function update(ProjectTask $projectTask): RedirectResponse
    {
        $validated = $this->validation(\request());
        $validated['project_id'] = $projectTask->project_id;
        $validated['user_id'] = $projectTask->user_id;
        $projectTask->update($validated);

        return redirect()->route('projectTasks.show', $projectTask['id']);
    }

    /**
     * @param Project $project
     * @return RedirectResponse
     */
    public function store(Project $project): RedirectResponse
    {
        $validated = $this->validation(\request());
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

        return redirect()->route('projectTasks.show', $projectTask['id']);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validation(Request $request): array
    {
        return $request->validate([
            'name' => 'required|max:50',
            'description' => 'max:500',
            'timeEst' => 'nullable|after_or_equal:today',
            'status' => 'nullable',
            'effort' => 'nullable',
            'priority' => 'nullable',
        ]);
    }
}
