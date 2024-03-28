<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProjectController extends Controller
{

    public function add(Project $project)
    {
        $userName = \request()->get('name');

        $user = User::where('name', $userName)->first();

        if ($user && !$project->isProjectMember($user)) {
            $project->users()->attach($user->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->route('projects.index')->with('error', "User is already member of project or Invalid username");
        }
    }

    public function remove(Project $project)
    {
        $userName = \request()->get('name');

        $user = User::where('name', $userName)->first();

        if ($user && $project->isProjectMember($user)) {
            $project->users()->detach($user->id);
            return redirect()->route('projects.index');
        } else {
            return redirect()->route('projects.index')->with('error', "User is not member of project or Invalid name");
        }
    }

    public function removeMe(Project $project)
    {
        $user = Auth::user();

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
            'usersProject' => $project->showProjectMember($project),
            'projects' => $project,
            'users' => $users
        ]);
    }
}
