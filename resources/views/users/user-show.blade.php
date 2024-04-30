@extends('helpers.header')

@section('title', $user->name)
@section('content')
    <body>
    <div>
        <h1>Info o uzivateli</h1>
        @if($editing ?? false)
            <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data"
                  class="profilePage">
                @csrf
                @method('put')
                <div class="editingProfile">
                    <h2>Edit profile</h2>
                    <p>Profile picture: </p>
                    @if($user->image === null)
                        <div class="photoUploaded">
                            <div class="photo">
                                <img src="{{ Auth::user()->getImageURL() }}" class="profilePhotoBig">
                            </div>
                            <div class="photoText">
                                <p>Upload your photo</p>
                                <p>Your photo should be in PNG or JPG format</p>
                                <div class="photoButtons">
                                    <input name="image" class="editing" type="file">
                                    @error('image')
                                    <span> {{ "[" . $message . "]" }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="photoUploaded">
                            <div class="photo">
                                <img src="{{ Auth::user()->getImageURL() }}" class="profilePhotoBig">
                            </div>
                            <div class="photoText">
                                <p>Upload your photo</p>
                                <p>Your photo should be in PNG or JPG format</p>
                                <div class="photoButtons">
                                    <input name="image" type="file">
                                    @error('image')
                                    <span> {{ "[" . $message . "]" }}</span>
                                    @enderror
                                    <a href="{{ route('removeProfilePhoto', $user->id) }}"
                                       class="removePhoto"
                                       onclick="return confirm('Do you really want to remove the profile picture?')">Remove</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="profileInfoDiv">
                        <div class="profileInfo">
                            <i class="fa-solid fa-user"></i>
                            <p>Username:</p>
                        </div>
                    </div>
                    <input name="name" class="editing" type="text" value="{{ $user->name }}">
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <div class="profileInfoDiv">
                        <div class="profileInfo">
                            <i class="fa-solid fa-align-justify"></i>
                            <p>Bio:</p>
                        </div>
                    </div>
                    <textarea name="bio" id="bio" rows="3" class="editing">{{ $user->bio }}</textarea>
                    @error('bio')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <div class="saveButtons">
                        @can('update', $user)
                            <a href="{{ route('profile') }}" class="cancelProfile">cancel</a>
                        @endcan
                        <button class="saveProfile">Save</button>
                    </div>
                </div>
            </form>
        @else
            <div class="photoContainer">
                <h1>Profile page</h1>
                <img src="{{ $user->getImageURL() }}" class="image">
                @can('update', $user)
                    <a href="{{ route('users.edit', $user->id) }}" class="editProfile">Edit
                        profile</a>
                @endcan
            </div>
            <div class="profilePage">

                <div class="profileInfoDiv">
                    <div class="profileInfo">
                        <i class="fa-solid fa-user"></i>
                        <p>Username:</p>
                    </div>
                    <p>{{ $user->name }}</p>
                </div>

                <div class="profileInfoDiv">
                    <div class="profileInfo">
                        <i class="fa-solid fa-envelope"></i>
                        <p>Email:</p>
                    </div>
                    <p>{{ $user->email }}</p>
                </div>

                @if(Auth::id() == $user->id)
                    <div class="profileInfoDiv">
                        <div class="profileInfo">
                            <i class="fa-solid fa-list-check"></i>
                            <p>Tasks count:</p>
                        </div>
                        <p>{{ $user->tasks()->count() }}</p>
                    </div>


                    <div class="profileInfoDiv">
                        <div class="profileInfo">
                            <i class="fa-solid fa-people-group"></i>
                            <p>Projects count:</p>
                        </div>
                        <p>{{ $user->allUserProjects() }}</p>
                    </div>

                @endif
            </div>

            @if($user->bio !== null)
                <div class="profileBio">
                    <div class="profileInfo">
                        <i class="fa-solid fa-align-justify"></i>
                        <p>Bio:</p>
                    </div>
                    <p>{{ $user->bio }}</p>
                </div>
            @endif

            <div class="boxUser">
                @can('update', $user)
                    <div class="boxTaskProfile">
                        <h3>My Projects:</h3>
                        @forelse($projects as $project)
                            @include('includes.project-card')
                        @empty
                            <p>You have not created projects yet</p>
                        @endforelse
                    </div>
                    <div class="boxTaskProfile">
                        <h3>Joined Projects:</h3>
                        @forelse($joinedProjects as $project)
                            @include('includes.project-card')
                        @empty
                            <p>You have not joined projects yet</p>
                        @endforelse
                    </div>
                @endcan
                @can('update', $user)
                    <div class="boxTaskProfileLast">
                        <h3>Tasks:</h3>
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
    @include('scripts.scripts')
@endsection
