<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('pages.create_task');
    }

    public function show(Task $task)
    {
        return view('pages.task-show', compact('task'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $validated = $this->validation(\request());
        $validated['user_id'] = auth()->id();
        Task::create($validated);

        return redirect()->route('ratio.home');
    }

    /**
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('ratio.home');
    }

    public function edit(Task $task)
    {
        $editing = true;
        return view('pages.task-show', compact('task', 'editing'));
    }

    /**
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(Task $task): RedirectResponse
    {
        $validated = $this->validation(\request());
        $validated['user_id'] = auth()->id();
        $task->update($validated);

        return redirect()->route('tasks.show', $task['id']);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validation(Request $request): array
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
