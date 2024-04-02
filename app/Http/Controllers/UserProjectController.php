<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserProjectController extends Controller
{

    /**
     * @param Project $project
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store(Project $project): RedirectResponse
    {
        $userName = \request()->get('email');

        $user = User::where('email', $userName)->first();

        if ($user && !$project->isProjectMember($user)) {
            $project->users()->attach($user->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->route('projects.index')->with('error', "User is already member of project or Invalid username");
        }
    }

    /**
     * @param Project $project
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function destroy(Project $project): RedirectResponse
    {
        $userName = \request()->get('email');

        $user = User::where('email', $userName)->first();

        if ($user && $project->isProjectMember($user)) {
            $project->users()->detach($user->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->route('projects.index')->with('error', "User is not member of project or Invalid name");
        }
    }

    public function show(Project $project)
    {
        $users = User::all();
        return view('includes.all-project-users', [
            'usersProject' => $project->showProjectToMember($project),
            'projects' => $project,
            'users' => $users
        ]);
    }

    /**
     * @param Project $project
     * @return RedirectResponse
     */
    public function removeMe(Project $project): RedirectResponse
    {
        $user = Auth::user();

        if ($user && $project->isProjectMember($user)) {
            $project->users()->detach($user->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->route('projects.index')->with('error', "User is not member of project or Invalid name");
        }
    }
}
