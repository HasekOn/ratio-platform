@extends('helpers.header')

@section('title', 'Your work')
@section('content')
    <body>
    <div class="box">
        <div class="boxTask">
            @include('alerts.error')
            <div class="scrollable-div">
                <div class="search">
                    <h3>Search</h3>
                    <form action="{{ route('ratio.home') }}" method="get" class="searchForm">
                        <input value="{{ request('search', '') }}" class="searchBar" placeholder="Search Task..."
                               type="text"
                               name="search">
                        <button class="searchBtn">Search</button>
                    </form>
                    <div class="taskButtons">
                        @include('pages.create_task')
                        <button class="createTaskBtn">Create new task</button>
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn createTaskBtn">Status <i
                                    class="fa-solid fa-chevron-down"></i></button>
                            <div id="myDropdown" class="dropdown-content selectStatus">
                                <a href="{{ url('/') }}">Inbox</a>
                                <a href="{{ route('status', 'TO PLAN') }}">To PLAN</a>
                                <a href="{{ route('status', 'TO DO') }}">To Do</a>
                                <a href="{{ route('status', 'IN PROGRESS') }}">IN PROGRESS</a>
                                <a href="{{ route('status', 'RETURNED') }}">RETURNED</a>
                                <a href="{{ route('status', 'TO REVIEW') }}">TO REVIEW</a>
                                <a href="{{ route('status', 'DONE') }}">DONE</a>
                                <a href="{{ route('status', 'TO CANCEL') }}">TO CANCEL</a>
                            </div>
                        </div>
                    </div>
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
