<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projet\CreateProjectRequest;
use App\Http\Requests\Projet\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $projects = Project::where('creator_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->latest()->get();

        return view('pages.project', [
            'projects' => $projects
        ]);
    }

    /**
     * @param Project $project
     * @throws AuthorizationException
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('pages.project-show', compact('project'));
    }

    /**
     * @param CreateProjectRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['creator_id'] = auth()->id();
        Project::create($validated);

        return redirect()->route('projects.index');
    }

    /**
     * @param Project $project
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index');
    }

    /**
     * @param Project $project
     * @throws AuthorizationException
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('includes.project-edit', compact('project'));
    }

    /**
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        $validated = $request->validated();
        $validated['creator_id'] = auth()->id();
        $project->update($validated);

        return redirect()->route('projects.index');
    }
}
