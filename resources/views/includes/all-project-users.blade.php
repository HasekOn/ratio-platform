@extends('helpers.header')

@section('content')
    <div class="bg-modal">
        <div class="modal-content2">
            <div class="close" id="close"><a href="{{ route('projects.index') }}">
                    <button>+</button>
                </a></div>
            <h3 class="showMembersH">Project members:</h3>
            <div class="showMembers">
                <div class="showMembersContent">
                    @foreach($users as $user)
                        @if($user->id === $projects->creator_id)
                            @if($user->name === Auth::user()->name)
                                <p class="showMembersAdmin">Admin:</p>
                                <p class="showMembersUser">{{ $user->name }} (me)</p>
                                <br>
                                <p class="showMembersAdmin">Members:</p>
                            @else
                                <p class="showMembersAdmin">Admin:</p>
                                <p class="showMembersUser">{{ $user->name }}</p>
                                <br>
                                <p class="showMembersAdmin">Members:</p>
                            @endif
                        @endif
                    @endforeach

                    @foreach($usersProject as $userProject)
                        @if($userProject->name === Auth::user()->name)
                            {{ $userProject->name }} (me)
                            <br>
                        @else
                            {{ $userProject->name }}
                            <br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('scripts.scripts')
@endsection
