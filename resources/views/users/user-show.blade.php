@extends('helpers.header')

@section('title', $user->name)
@section('content')
    <body>
    <div>
        <h1>Info o uzivateli</h1>
        @if($editing ?? false)
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data"
                  class="profilPage">
                @csrf
                @method('put')
                <p>Profile picture: </p>
                @if($user->image === null)
                    <input name="image" class="editing" type="file">
                    @error('image')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                @else
                    <img src="{{ Auth::user()->getImageURL() }}" class="profilePhotoBig">
                    <a href="{{ route('removeProfilePhoto', $user->id) }}" class="editProfile">Remove profile photo</a>
                    <input name="image" class="editing" type="file">
                    @error('image')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                @endif
                <p>Username: </p>
                <input name="name" class="editing" type="text" value="{{ $user->name }}">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <p>Bio: </p>
                <textarea name="bio" id="bio" rows="3" class="editing">{{ $user->bio }}</textarea>
                @error('bio')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <button class="saveProfile">Save</button>
                @can('update', $user)
                    <a href="{{ route('profile') }}" class="editProfile">Return to profile</a>
                @endcan
            </form>
        @else
            <div class="profilePage">
                <img src="{{ $user->getImageURL() }}" class="image">
                <br>
                <p>Username: {{ $user->name }}</p>
                <br>
                <p>Email: {{ $user->email }}</p>
                <br>
                @if(Auth::id() == $user->id)
                    <p>Tasks count: {{ $user->tasks()->count() }}</p>
                    <br>
                    <p>Projects count: {{ $user->allUserProjects() }}</p>
                    <br>
                @endif
                <p>Bio: {{ $user->bio }}</p>
                <hr>
                @can('update', $user)
                    <a href="{{ route('users.edit', $user->id) }}" class="editProfile">Edit profile</a>
                @endcan
            </div>

            <div class="box">
                @can('update', $user)
                    <div class="boxTaskProfile">
                        My Projects:
                        @forelse($projects as $project)
                            @include('includes.project-card')
                        @empty
                            <p>You have not created projects yet</p>
                        @endforelse
                    </div>
                    <div class="boxTaskProfile">
                        Joined Projects:
                        @forelse($joinedProjects as $project)
                            @include('includes.project-card')
                        @empty
                            <p>You have not joined projects yet</p>
                        @endforelse
                    </div>
                @endcan
                @can('update', $user)
                    <div class="boxTaskProfileLast">
                        Tasks:
                        @forelse($tasks as $task)
                            @include('includes.task-card')
                        @empty
                            <p>No tasks Found</p>
                        @endforelse
                    </div>
                @endcan
            </div>
        @endif
    </div>
    </body>
@endsection
