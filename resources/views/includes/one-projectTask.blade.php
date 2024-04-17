<div class="boxPagePreview">
    <div class="boxTaskPage">
        <div class="taskEdit">
            <p>Name: {{ $projectTask->name }}</p>
            <p>Status: {{ $projectTask->status }}</p>
            <p>Effort: {{ $projectTask->effort }}</p>
            <p>Priority: {{ $projectTask->priority }}</p>
            <p>Complete by: {{ $projectTask->timeEst }}</p>
            <p>Description: {{ $projectTask->description }}</p>
            <a href="{{ route('userProfile', $projectTask->user_id) }}" class="">Created by: {{ $projectTask->getUserNameById($projectTask->user_id) }}</a>
            <div>
                <form method="post" action="{{ route('projectTasks.destroy', $projectTask->id) }}"
                      onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('delete')
                    <a href="{{ route('projectTasks.edit', $projectTask->id) }}">Edit</a>
                    <button class="deleteTask" type="submit"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>

    <div class="boxTaskPageCom">
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
