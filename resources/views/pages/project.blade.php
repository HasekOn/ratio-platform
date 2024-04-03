@extends('helpers.header')

@section('content')
    <body>
    <div class="projectBox">
        @include('pages.create_project')
        <button class="createBtnP">Vytvořit nový projekt</button>

        @forelse($projects as $project)
            @include('includes.project-card')
        @empty
            <p>No projects found</p>
        @endforelse
    </div>
    </body>

    @include('scripts.scripts')
@endsection
