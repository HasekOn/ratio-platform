<a href="{{ route('tasks.show', $task->id) }}">
    <div class="task">
        <p>Name: {{ $task->name }}</p>
        @if(!empty($task->status))
        <p>Status: {{ $task->status }}</p>
            @if($task->status === 'TO CANCEL')
            <form method="post" action="{{ route('tasks.destroy', $task->id) }}"
                  onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('delete')
                <button class="deleteTask" type="submit"><i class="fa-solid fa-trash"></i></button>
            </form>
            @endif
        @endif
        @if(!empty($task->timeEst))
            <p>Complete by: {{ \Carbon\Carbon::parse($task->timeEst)->format('M-d') }}</p>
        @endif
    </div>
</a>
