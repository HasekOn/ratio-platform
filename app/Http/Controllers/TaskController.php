<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('pages.create_task');
    }

    public function store()
    {
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
}
