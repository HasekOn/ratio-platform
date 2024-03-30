@extends('helpers.header')

@section('content')
    <body>
    <div>
        <h1>Info o uzivateli</h1>
        @if($editing ?? false)
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @auth()
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('profile') }}">View</a>
                    @endif
                @endauth
                <p>Profile picture: </p>
                <input name="image" class="editing" type="file">
                @error('image')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <p>Name: </p>
                <input name="name" class="editing" type="text" value="{{ $user->name }}">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <p>Bio: </p>
                <textarea name="bio" id="bio" rows="3">{{ $user->bio }}</textarea>
                @error('bio')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <button>Save</button>
            </form>
        @else
            @auth()
                @if(Auth::id() === $user->id)
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                @endif
            @endauth
            <img src="{{ $user->getImageURL() }}" class="image">
            <br>
            <span>Username: {{ $user->name }}</span>
            <br>
            <span>Pocet tasku: {{ $user->tasks()->count() }}</span>
            <br>
            <span>Bio: {{ $user->bio }}</span>
            <hr>
                @if(Auth::id() === $user->id)
                    My Projects:
                    @forelse($projects as $project)
                        @include('includes.project-card')
                    @empty
                        <p>You have not created projects yet</p>
                    @endforelse
                    Joined Projects:
                    @forelse($joinedProjects as $project)
                        @include('includes.project-card')
                    @empty
                        <p>You have not joined projects yet</p>
                    @endforelse
        @endif
            @if(Auth::id() === $user->id)
                Tasks:
                @forelse($tasks as $task)
                    @include('includes.task-card')
                @empty
                    <p>No tasks Found</p>
                @endforelse
            @endif
        @endif
    </div>
    </body>
@endsection
