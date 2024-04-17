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
            <form action="{{ route('projects.index') }}" method="get" class="hovno">
                <input value="{{ request('search', '') }}" class="searchBar" placeholder="..." type="text"
                       name="search">
                <button class="searchBtn">Search</button>
            </form>
            @include('pages.create_project')
            <button class="createTaskBtn">Create new Project</button>
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
