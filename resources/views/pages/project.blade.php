@extends('helpers.header')

@section('title', 'Projects')
@section('content')
    <body>
    <div class="projectBtn">
        <div class="search">
            @include('alerts.success')
            @include('alerts.error')
            <h1 class="projectText">Projects</h1>
            <h2 class="projectText">Search</h2>
            <form action="{{ route('projects.index') }}" method="get" class="searchForm">
                <input value="{{ request('search', '') }}" class="searchBarProject" placeholder="..." type="text"
                       name="search">
                <button class="createTaskBtn">Search</button>
            </form>
            @include('pages.create_project')
            <button class="createTaskBtn">Vytvořit nový projekt</button>
        </div>
    </div>
    <div class="projectBox">
        @forelse($projects as $project)
            @include('includes.project-card')
        @empty
            <p>No projects found</p>
        @endforelse
    </div>
    </body>
    @include('scripts.scripts')
@endsection
