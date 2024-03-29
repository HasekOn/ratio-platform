@extends('helpers.header')

@section('content')
    <body>
    <div class="box">
        <ul class="taskMenu">
            <li><a href="{{ url('/') }}">Inbox</a></li>
            <li>To Do</li>
            <li>Done</li>
        </ul>
        @include('pages.create_task')
        <button>Create new task</button>
        <div class="boxTask">
            <div class="search">
                <h5>Search</h5>
                <form action="{{ route('ratio.home') }}" method="get">
                    <input value="{{ request('search', '') }}" class="searchBar" placeholder="..." type="text"
                           name="search">
                    <button class="searchButton">Search</button>
                </form>
            </div>
            @forelse($tasks as $task)
                @include('includes.task-card')
            @empty
                <p>No Results Found</p>
            @endforelse
        </div>
        {{--
        <div class="boxTaskInvisible">
            <div class="square">
                @include('includes.one-task')
            </div>
        </div>
        --}}
    </div>
    </body>

    @include('scripts.scripts')
@endsection
