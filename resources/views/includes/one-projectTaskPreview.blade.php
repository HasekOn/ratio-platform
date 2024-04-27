<div class="boxPage">
    <div class="boxTaskPage">
        <div class="bigTask">
            <div class="taskHeader">
                <div>
                    <p class="taskName">{{ $projectTask->name }} [RP-{{ $projectTask->id }}]</p>
                </div>
                <div class="taskUpdate">
                    <p>Last Updated: {{ \Carbon\Carbon::parse($projectTask->updated_at)->diffForHumans()}}</p>
                </div>
            </div>
            <div class="taskInfo">
                <i class="fa-solid fa-info"></i>
                <p>General Info</p>
            </div>
            <div class="taskBody">
                <div class="taskSubtitle">
                    <div class="labels">
                        <p>Status:</p>
                        <p class="taskStatus">{{ $projectTask->status }}</p>
                    </div>
                    <div class="labels">
                        <p>Effort:</p>
                        <p class="taskEffort">{{ $projectTask->effort }}</p>
                    </div>
                    <div class="labels">
                        <p>Priority:</p>
                        <p class="taskPriority">{{ $projectTask->priority }}</p>
                    </div>
                    <div>
                        <div class="taskDate">
                            <i class="fa-regular fa-calendar"></i>
                            <p>Complete by:</p>
                        </div>
                        <p>{{ $projectTask->timeEst }}</p>
                    </div>
                    <div>
                        <div class="taskCreator">
                            <i class="fa-solid fa-user"></i>
                            <p>Created by:</p>
                        </div>
                        <a href="{{ route('users.show', $projectTask->user_id) }}" class="userLink">
                            <p>{{ $projectTask->getUserNameById($projectTask->user_id) }}</p></a>
                    </div>
                    <div>
                        <div class="taskCreator">
                            <i class="fa-solid fa-user-check"></i>
                            <p>Assignee:</p>
                        </div>
                        @if($projectTask->assignee === null)
                            <p>Nobody</p>
                        @else
                            <div class="assignedUsers">
                                <a href="{{ route('users.show', $projectTask->assignee) }}" class="userLink">
                                    <p>{{ $projectTask->getUserNameById($projectTask->assignee) }}</p></a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="taskDescription">
                    <div class="taskDescriptionHeader">
                        <i class="fa-regular fa-newspaper"></i>
                        <p>Description:</p>
                    </div>
                    <p>{{ $projectTask->description }}</p>
                </div>

                <div class="taskComments">
                    <div class="taskCommentsHeader">
                        <i class="fa-solid fa-comments"></i>
                        <p>Comments:</p>
                    </div>
                    @forelse($projectTask->comments as $comment)
                        <div class="bigComment">
                            <div class="commentUser">
                                <img src="{{ $comment->getUserImageById($comment->user_id) }}" class="profilePhoto">
                                <p> {{ $comment->getUserNameById($comment->user_id) }} </p>
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i') }}
                                | {{ \Carbon\Carbon::parse($comment->created_at)->format('M-d') }} |
                            </div>
                            <p class="commentText">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <p>No comment found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

