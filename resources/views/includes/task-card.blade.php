<a href="{{ route('tasks.show', $task->id) }}">
    <div class="task">
        <p>{{ $task->name }}</p>
        <p>{{ $task->status }}</p>
        @if(!empty($task->timeEst))
            <p>{{ \Carbon\Carbon::parse($task->timeEst)->format('M-d') }}</p>
        @endif
    </div>
</a>
