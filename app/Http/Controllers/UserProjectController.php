<?php

namespace App\Http\Controllers;

use App\Mail\InvitationEmail;
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
        $user->setRememberToken(Str::random(60));
        $user->save();

        if ($user && !$project->isProjectMember($user) && $user->id!== $project->creator_id) {
            Mail::to($userName)->send(new InvitationEmail($user->remember_token, $project));
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

        if ($user && $project->isProjectMember($user) && $user->id!== $project->creator_id) {
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

    /**
     * @param string $remember_token
     * @param User $user
     * @param Project $project
     * @return RedirectResponse
     */
    public function attachMemberToProject(string $remember_token, Project $project): RedirectResponse
    {
        if ($remember_token === Auth::user()->getRememberToken()){
            if (!$project->isProjectMember(Auth::user()) && Auth::id() !== $project->creator_id){
                $project->users()->attach(Auth::id());
                Auth::user()->setRememberToken(null);
                Auth::user()->save();
            }
        }
        return redirect()->route('projects.index');
    }
}
