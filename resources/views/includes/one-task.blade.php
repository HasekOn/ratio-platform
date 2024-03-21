<div class="boxTask">
    <div class="task">
        <p>{{ $task->name }}</p>
        <p>{{ $task->status }}</p>
        <p>{{ $task->effort }}</p>
        <p>{{ $task->priority }}</p>
        <p>{{ $task->timeEst }}</p>
        <p>{{ $task->description }}</p>
        <div>
            <form method="post" action="{{ route('tasks.destroy', $task->id) }}"
                  onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('delete')
                <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                <button class="delete" type="submit">+</button>
            </form>
        </div>
    </div>
</div>
