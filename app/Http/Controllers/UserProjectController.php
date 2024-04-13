<?php

namespace App\Http\Controllers;

use App\Mail\InvitationEmail;
use App\Models\Invitation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

        if ($user && !$project->isProjectMember($user) && $user->id!== $project->creator_id) {
            $invitation = new Invitation();
            $invitation->user_id = $user->id;
            $invitation->project_id = $project->id;
            $invitation->remember_token = Str::random(60);
            $invitation->save();

            Mail::to($userName)->send(new InvitationEmail($invitation->remember_token, $invitation, $project));

            return redirect()->route('projects.index')->with('success', 'The invitation has been successfully sent.');
        } elseif ($user?->id === $project->creator_id) {
            return redirect()->route('projects.index')->with('error', "You cant add yourself to the project.");
        } else {
            return redirect()->route('projects.index')->with('error', "User is already member of project or Invalid email");
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

        if ($user && $project->isProjectMember($user) && $user->id!== $project->creator_id) {
            $project->users()->detach($user->id);
            return redirect()->route('projects.index');
        } elseif ($user?->id === $project->creator_id) {
            return redirect()->route('projects.index')->with('error', "You cant remove yourself from project yet");
        } else {
            return redirect()->route('projects.index')->with('error', "User is not member of project or Invalid email");
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
