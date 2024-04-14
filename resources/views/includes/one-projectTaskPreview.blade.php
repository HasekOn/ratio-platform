<div class="boxPage">
    <div class="boxTaskPage">
        <div class="task">
            <p>{{ $projectTask->name }}</p>
            <p>{{ $projectTask->status }}</p>
            <p>{{ $projectTask->effort }}</p>
            <p>{{ $projectTask->priority }}</p>
            <p>{{ $projectTask->timeEst }}</p>
            <p>{{ $projectTask->description }}</p>
            <p>Created by: {{ $projectTask->getUserNameById($projectTask->user_id) }}</p>
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
    </div>
</div>
