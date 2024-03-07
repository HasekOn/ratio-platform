<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class YourWorkController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'DESC');
        if (\request()->has('search')) {
            $tasks->where('name', 'like', '%' . \request()->get('search') . '%');
        }

        return view('pages.index', [
            'tasks' => $tasks->get()
        ]);
    }
}
