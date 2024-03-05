<a href="{{ route('tasks.show', $task->id) }}">
<div class="task">
    <p>{{ $task->name }}</p>
    <p>{{ $task->status }}</p>
    <p>{{ $task->timeEst }}</p>
    </div>
</a>
