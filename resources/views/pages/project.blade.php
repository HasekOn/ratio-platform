@extends('helpers.header')

@section('content')
    <body>
    @include('pages.create_project')
    <button class="createBtnP">Vytvořit nový projekt</button>

    @forelse($projects as $project)
        @include('includes.project-card')
    @empty
        <p>No projects found</p>
    @endforelse
    </body>

    @include('scripts.scripts')
@endsection
