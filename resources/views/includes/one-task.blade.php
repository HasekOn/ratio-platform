<div class="box">
<div class="boxTask">
    <div class="singleTask">
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

<div class="boxTask">
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
