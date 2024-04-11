<a href="{{ route('tasks.show', $task->id) }}">
    <div class="task">
        <p>Name: {{ $task->name }}</p>
        @if(!empty($task->status))
        <p>Status: {{ $task->status }}</p>
        @endif
        @if(!empty($task->timeEst))
            <p>Complete by: {{ \Carbon\Carbon::parse($task->timeEst)->format('M-d') }}</p>
        @endif
    </div>
</a>
