<div class="boxPage">
    <div class="boxTaskPage">
        <div class="task">
            <p>Name: {{ $task->name }}</p>
            <p>Status: {{ $task->status }}</p>
            <p>Effort: {{ $task->effort }}</p>
            <p>Priority: {{ $task->priority }}</p>
            <p>Complete by: {{ $task->timeEst }}</p>
            <p>Description: {{ $task->description }}</p>
            <div>
                <form method="post" action="{{ route('tasks.destroy', $task->id) }}"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('delete')
                    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                    <button class="deleteTask" type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="boxTaskPageCom">
        @forelse($task->comments as $comment)
            {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i') }} -
            {{ $comment->content }}
            | {{ \Carbon\Carbon::parse($comment->created_at)->format('M-d') }} |
            <br>
        @empty
            <p>No comment found</p>
        @endforelse
        <div class="singleTask">
            <div>
                <form method="post" action="{{ route('tasks.comments.store', $task->id) }}">
                    @csrf
                    <textarea rows="1" name="content"></textarea>
                    <button class="loginText" type="submit">Post comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
