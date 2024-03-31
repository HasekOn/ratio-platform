@extends('helpers.header')

@section('content')
    <body>
    <h1>{{$project->name}}</h1>
    <div class="box">
        @include('pages.create_projectTask')
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
            @forelse($project->tasks as $task)
                @include('includes.task-card')
            @empty
                <p>No Tasks Found</p>
            @endforelse
        </div>
    </div>
    </body>
    @include('scripts.scripts')
@endsection
