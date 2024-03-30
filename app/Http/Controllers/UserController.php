<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $editing = true;
        $tasks = $user->tasks()->paginate();
        return view('users.user-show', compact('user', 'editing', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = \request()->validate([
            'name' => 'required|min:3|max:40',
            'bio' => 'nullable|max:255',
            'image' => 'image'
        ]);

        if (\request()->has('image')) {
            $imagePath = \request()->file('image')->store('profile', 'public');
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
}
