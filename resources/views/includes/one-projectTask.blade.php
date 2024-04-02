<div class="box">
    <div class="boxTask">
        <div class="singleTask">
            <p>{{ $projectTask->name }}</p>
            <p>{{ $projectTask->status }}</p>
            <p>{{ $projectTask->effort }}</p>
            <p>{{ $projectTask->priority }}</p>
            <p>{{ $projectTask->timeEst }}</p>
            <p>{{ $projectTask->description }}</p>
            <p>Created by: {{ $projectTask->getUserNameById($projectTask->user_id) }}</p>
            <div>
                <form method="post" action="{{ route('projectTasks.destroy', $projectTask->id) }}"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('delete')
                    <a href="{{ route('projectTasks.edit', $projectTask->id) }}">Edit</a>
                    <button class="delete" type="submit">+</button>
                </form>
            </div>
        </div>
    </div>

    <div class="boxTask">
        @forelse($projectTask->comments as $comment)
            {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i') }} -
            {{ $comment->content }}
            | {{ \Carbon\Carbon::parse($comment->created_at)->format('M-d') }} |
            ( {{ $comment->getUserNameById($comment->user_id) }} )
            <br>
        @empty
            <p>No comment found</p>
        @endforelse
        <div class="singleTask">
            <div>
                <form method="post" action="{{ route('projectTasks.comments.store', $projectTask->id) }}">
                    @csrf
                    <textarea rows="1" name="content"></textarea>
                    <button class="loginText" type="submit">Post comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
