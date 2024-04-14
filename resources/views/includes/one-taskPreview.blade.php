<div class="boxPage">
    <div class="boxTaskPage">
        <div class="task">
            <p>Name: {{ $task->name }}</p>
            <p>Status: {{ $task->status }}</p>
            <p>Effort: {{ $task->effort }}</p>
            <p>Priority: {{ $task->priority }}</p>
            <p>Complete by: {{ $task->timeEst }}</p>
            <p>Description: {{ $task->description }}</p>
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
    </div>
</div>
