<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class YourWorkController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'tasks' => Task::orderBy('created_at', 'DESC')->get()
        ]);
    }
}
