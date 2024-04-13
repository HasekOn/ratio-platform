<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YourWorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->latest();
        if (\request()->has('search')) {
            $tasks->where('name', 'like', '%' . \request()->get('search') . '%');
        }

        return view('pages.index', [
            'tasks' => $tasks->get(),
        ]);
    }

    /**
     * @param string $status
     */
    public function getTaskByStatus(string $status)
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->where('status', $status)->latest()->get();

        return view('pages.index', [
            'tasks' => $tasks,
        ]);
    }
}
