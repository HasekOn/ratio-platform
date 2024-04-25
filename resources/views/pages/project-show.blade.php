@extends('helpers.header')

@section('title', $project->name)
@section('content')
    <body>
    <h1 class="projectName">{{$project->name}}</h1>
    <div class="box">
        <div class="boxTask">
            @include('alerts.error')
            <div class="scrollable-div">
                <div class="search">
                    <h3>Search</h3>
                    <form action="{{ route('search', $project->id) }}" method="get" class="searchForm">
                        <input value="{{ request('search', '') }}" class="searchBar" placeholder="..." type="text"
                               name="search">
                        <button class="searchBtn">Search</button>
                    </form>
                    <div class="taskButtons">
                        @include('pages.create_projectTask')
                        <button class="createTaskBtn">Create new task</button>
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn createTaskBtn">Status <i
                                    class="fa-solid fa-chevron-down"></i></button>
                            <div id="myDropdown" class="dropdown-content selectStatus">
                                <a href="{{ route('projects.show', $project->id) }}">Inbox</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'TO PLAN']) }}">TO PLAN</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'TO DO']) }}">TO DO</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'IN PROGRESS']) }}">IN PROGRESS</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'RETURNED']) }}">RETURNED</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'TO REVIEW']) }}">TO REVIEW</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'DONE']) }}">DONE</a>
                                <a href="{{ route('projectTaskStatus', [$project, 'TO CANCEL']) }}">TO CANCEL</a>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse($projectTasks as $task)
                    @include('includes.projectTask-card')
                @empty
                    <p>No Tasks Found</p>
                @endforelse
            </div>
        </div>
        <div id="task-details" class="task-details"></div>
    </div>
    </body>
    @include('scripts.scripts')
@endsection
