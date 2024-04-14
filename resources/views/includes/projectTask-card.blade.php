<div class="task">
    <div class="task-link  project-task-link" data-id="{{ $task->id }}">
        <p>{{ $task->name }}</p>
        @if(!empty($task->status))
            <p>Status: {{ $task->status }}</p>
        @endif
        @if(!empty($task->timeEst))
            <p>Complete by: {{ \Carbon\Carbon::parse($task->timeEst)->format('M-d') }}</p>
        @endif
        <p>Created by: {{ $task->getUserNameById($task->user_id) }}</p>
    </div>
    <a href="{{ route('projectTasks.show', $task->id) }}"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></a>
    @if($task->status === 'TO CANCEL')
        <form method="post" action="{{ route('projectTasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('delete')
            <button class="deleteTask" type="submit"><i class="fa-solid fa-trash"></i></button>
        </form>
    @endif
</div>
