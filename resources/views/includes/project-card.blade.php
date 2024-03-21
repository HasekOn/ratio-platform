<a href="{{ route('projects.show', $project->id) }}">
    <div class="task">
        <p>{{ $project->name }}</p>
        <p>{{ $project->effort }}</p>
        @if(!empty($project->timeEst))
            <p>{{ \Carbon\Carbon::parse($project->timeEst)->format('M-d') }}</p>
        @endif
        <form method="post" action="{{ route('projects.destroy', $project->id) }}"
              onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('delete')
            <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
            <button class="delete" type="submit">+</button>
        </form>
    </div>
</a>
