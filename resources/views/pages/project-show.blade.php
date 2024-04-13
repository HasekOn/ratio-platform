@extends('helpers.header')

@section('title', $project->name)
@section('content')
    <body>
    <h1 class="projectName">{{$project->name}}</h1>
    <div class="box">
        <ul class="taskMenu">
            <li><a href="{{ route('projects.show', $project->id) }}">Inbox</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'TO DO']) }}">To Do</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'In PROGRESS']) }}">In PROGRESS</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'RETURNED']) }}">RETURNED</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'TO REVIEW']) }}">TO REVIEW</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'DONE']) }}">DONE</a></li>
            <li><a href="{{ route('projectTaskStatus', [$project, 'TO CANCEL']) }}">TO CANCEL</a></li>
        </ul>
        <div class="boxTask">
            @include('alerts.error')
            <div class="search">
                <h5>Search</h5>
                <form action="{{ route('search', $project->id) }}" method="get" class="searchForm">
                    <input value="{{ request('search', '') }}" class="searchBar" placeholder="..." type="text"
                           name="search">
                    <button class="createTaskBtn">Search</button>
                </form>
                @include('pages.create_projectTask')
                <button class="createTaskBtn">Create new task</button>
            </div>
            @forelse($projectTasks as $task)
                @include('includes.projectTask-card')
            @empty
                <p>No Tasks Found</p>
            @endforelse
        </div>
    </div>
    </body>
    @include('scripts.scripts')
@endsection
