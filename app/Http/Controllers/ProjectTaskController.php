<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function store(Project $project)
    {
        $validated = $this->validation(\request());
        $validated['project_id'] = $project->id;
        $validated['user_id'] = auth()->id();
        ProjectTask::create($validated);

        return redirect()->route('projects.show', $project->id);
    }
    public function validation(Request $request)
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
