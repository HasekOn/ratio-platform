<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return view('pages.create_task');
    }

    public function show(Task $task){
        return view('pages.task-show', compact('task'));
    }

    public function store(){

        \request()->validate([
            'name' => 'required|max:50',
            'description' => 'max:500',
            'timeEst' => 'nullable|after_or_equal:today'
        ]);

        $tasks = Task::create([
            'name' => \request()->get('name'),
            'status' => \request()->get('status'),
            'effort' => \request()->get('effort'),
            'priority' => \request()->get('priority'),
            'timeEst' => \request()->get('timeEst'),
            'description' => \request()->get('description'),
        ]);

        return redirect()->route('ratio.home');
    }

    public function edit(Task $task){
        $editing = true;
        return view('pages.task-show', compact('task', 'editing'));
    }

    public function update(Task $task){

        \request()->validate([
            'name' => 'required|max:50',
            'description' => 'max:500',
            'timeEst' => 'nullable|after_or_equal:today'
        ]);


        $task['name'] = \request()->get('name', '');
        $task['status'] = \request()->get('status', '');
        $task['effort'] = \request()->get('effort', '');
        $task['priority'] = \request()->get('priority', '');
        $task['timeEst'] = \request()->get('timeEst', '');
        $task['description'] = \request()->get('description', '');
        $task->save();

        return redirect()->route('tasks.show', $task['id']);
    }

    public function destroy(Task $id){
        $id->delete();

        return redirect()->route('ratio.home');
    }
}
