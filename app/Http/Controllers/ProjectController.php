<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('pages.project', [
            'projects' => $projects
        ]);
    }

    public function show(Project $project)
    {
        return view('pages.project-show', compact('project'));
    }

    public function store()
    {
        $validated = $this->validation(\request());
        $validated['creator_id'] = auth()->id();
        Project::create($validated);

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        return view('includes.project-edit', compact('project'));
    }

    public function update(Project $project)
    {
        $validated = $this->validation(\request());
        $validated['creator_id'] = auth()->id();
        $project->update($validated);

        return redirect()->route('projects.index');
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:50',
            'description' => 'max:500',
            'timeEst' => 'nullable|after_or_equal:today',
            'effort' => 'nullable',
        ]);
    }
}
