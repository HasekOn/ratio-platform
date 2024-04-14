@extends('helpers.header')

@section('title', 'Your work')
@section('content')
    <body>
    <div class="box">
        <ul class="taskMenu">
            <li><a href="{{ url('/') }}">Inbox</a></li>
            <li><a href="{{ route('status', 'TO PLAN') }}">To PLAN</a></li>
            <li><a href="{{ route('status', 'TO DO') }}">To Do</a></li>
            <li><a href="{{ route('status', 'IN PROGRESS') }}">IN PROGRESS</a></li>
            <li><a href="{{ route('status', 'RETURNED') }}">RETURNED</a></li>
            <li><a href="{{ route('status', 'TO REVIEW') }}">TO REVIEW</a></li>
            <li><a href="{{ route('status', 'DONE') }}">DONE</a></li>
            <li><a href="{{ route('status', 'TO CANCEL') }}">TO CANCEL</a></li>
        </ul>
        <div class="boxTask">
            @include('alerts.error')
            <div class="scrollable-div">
                <div class="search">
                    <h5>Search</h5>
                    <form action="{{ route('ratio.home') }}" method="get" class="searchForm">
                        <input value="{{ request('search', '') }}" class="searchBar" placeholder="..." type="text"
                               name="search">
                        <button class="createTaskBtn">Search</button>
                    </form>
                    @include('pages.create_task')
                    <button class="createTaskBtn">Create new task</button>
                </div>

                @forelse($tasks as $task)
                    @include('includes.task-card')
                @empty
                    <p>No Tasks Found</p>
                @endforelse
            </div>
        </div>
            <div id="task-details"></div>
    </div>
    </body>

    @include('scripts.scripts')
@endsection
