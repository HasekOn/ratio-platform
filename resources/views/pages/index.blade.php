@extends('helpers.header')

@section('content')
    <body>
    <div class="box">
        <ul class="taskMenu">
            <li><a href="{{ url('/') }}">Inbox</a></li>
            <li>To Do</li>
            <li>Done</li>
            <li><a href="{{ url('/create-task') }}">New Task</a></li>
        </ul>
        <div class="boxTask">
            @foreach($tasks as $task)
                @include('includes.task-card')
            @endforeach
        </div>
    </div>
    </body>
@endsection
