<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $projects = $user->project;
        $joinedProjects = $user->showProjectToMember($user);
        $tasks = $user->tasks()->latest()->paginate();
        return view('users.user-show', compact('user', 'tasks', 'projects', 'joinedProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $editing = true;
        $tasks = $user->tasks()->paginate();
        return view('users.user-show', compact('user', 'editing', 'tasks'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;
            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }

    public function userProfile(User $user)
    {
        return $this->show($user);
    }

    public function removeProfilePhoto(User $user)
    {
        $this->authorize('update', $user);
        $editing = true;
        $tasks = $user->tasks()->paginate();
        $user->image = null;
        $user->save();
        return view('users.user-show', compact('user', 'editing', 'tasks'));
    }
}
