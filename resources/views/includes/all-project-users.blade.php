@foreach($users as $user)
    @if($user->id === $projects->creator_id)
        @if($user->name === Auth::user()->name)
            Admin: {{ $user->name }} (me)
            <br>
            Members:
            <br>
        @else
            Admin: {{ $user->name }}
            <br>
            Members:
            <br>
        @endif
    @endif
@endforeach

@foreach($usersProject as $userProject)
    @if($userProject->name === Auth::user()->name)
        - {{ $userProject->name }} (me)
        <br>
    @else
        - {{ $userProject->name }}
        <br>
    @endif
@endforeach
