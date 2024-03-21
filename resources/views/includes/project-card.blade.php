@if($project->isProjectMember(Auth::user()) || $project->creator_id === Auth::user()->id)
    <a href="{{ route('projects.show', $project->id) }}">
        <div class="task">
            <p>{{ $project->name }}</p>
            <p>{{ $project->effort }}</p>
            @if(!empty($project->timeEst))
                <p>{{ \Carbon\Carbon::parse($project->timeEst)->format('M-d') }}</p>
            @endif
            @if(Auth::user()->id === $project->creator_id)
                <form method="post" action="{{ route('projects.destroy', $project->id) }}"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('delete')
                    <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
                    <button class="delete" type="submit">+</button>
                </form>
                <button type="button" onclick="openModal()" class="btn btn-primary">Organize members</button>
                @include('includes.organize-members')
                @include('scripts.scripts')
                @include('alerts.invalid-name')
            @endif
        </div>
    </a>
@endif
