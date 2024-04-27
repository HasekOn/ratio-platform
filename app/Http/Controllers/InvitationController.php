<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    /**
     * @param string $remember_token
     * @param Invitation $invitation
     * @param Project $project
     * @return RedirectResponse
     */
    public function attachMemberToProject(string $remember_token, Invitation $invitation, Project $project): RedirectResponse
    {
        if ($invitation->getInvitation(Auth::id(), $project->id, $remember_token) && $invitation->remember_token !== null) {
            if (!$project->isProjectMember(Auth::user()) && Auth::id() !== $project->creator_id) {
                $project->users()->attach(Auth::id());
                $project->save();
                $invitation->remember_token = null;
                $invitation->save();
                return redirect()->route('projects.index')->with('success', "You have been successfully added to the project.");
            }
        }
        return redirect()->route('projects.index')->with('error', "You cannot be added to the team.");
    }
}
