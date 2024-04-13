<div class="project">
    <a href="{{ route('projects.show', $project->id) }}">
        <p>{{ $project->name }}</p>
        @if(!empty($project->effort))
            <p>Effort: {{ $project->effort }}</p>
        @endif
        @if(!empty($project->timeEst))
            <p>Complete by: {{ \Carbon\Carbon::parse($project->timeEst)->format('M-d') }}</p>
        @endif
        @if(Auth::user()->id === $project->creator_id)
            <form method="post" action="{{ route('projects.destroy', $project->id) }}"
                  onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('delete')
                <a href="{{ route('projects.edit', $project->id) }}" class="edit"><i class="fa-solid fa-pencil"></i></a>
                <button class="delete" type="submit"><i class="fa-solid fa-trash"></i></button>
            </form>
            <button type="button" onclick="openModal()" class="projectCardBtn">Organize members</button>
            @include('includes.organize-members')
            @include('scripts.scripts')
        @endif
        @if( $project->creator_id !== Auth::user()->id)
            <form action="{{ route('projectUsers.removeMe', $project->id) }}" method="post"
                  onsubmit="return confirm('Are you sure?');" class="ProjectForm">
                @csrf
                <button type="submit" class="projectCardBtn">Leave Project</button>
            </form>
        @endif
        <a href="{{ route('projectUsers.show', $project->id) }}" class="projectCardBtn">Show members</a>
    </a>
</div>
