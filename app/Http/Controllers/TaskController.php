<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        return view('pages.create_task');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('pages.task-show', compact('task'));
    }

    public function showTaskPreview(Task $task)
    {
        $this->authorize('view', $task);

        return view('includes.one-taskPreview', compact('task'))->render();
    }

    /**
     * @param CreateTaskRequest $request
     * @return RedirectResponse
     */
    public function store(CreateTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        Task::create($validated);

        return redirect()->route('ratio.home');
    }

    /**
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $task->update($validated);

        return redirect()->route('tasks.show', $task['id']);
    }

    /**
     * @param Task $task
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Task $task): RedirectResponse
    {

        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('ratio.home');
    }

    /**
     * @param Task $task
     * @throws AuthorizationException
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $editing = true;
        return view('pages.task-show', compact('task', 'editing'));
    }
}
