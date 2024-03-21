@extends('helpers.header')

@section('content')
    <body>
    @forelse($projects as $project)
        @include('includes.project-card')
    @empty
        <p>No Projects Found</p>
    @endforelse
    @include('pages.create_project')
    <button>Create new project</button>
    </body>
    @include('scripts.scripts')
@endsection
