<div class="boxPage">
    <div class="boxTaskPage">
        <div class="bigTask">
            <div class="taskHeader">
                <div>
                    <p class="taskName">{{ $projectTask->name }}</p>
                </div>
                <div class="taskUpdate">
                    <p>Last Updated: {{ \Carbon\Carbon::parse($projectTask->updated_at)->diffForHumans()}}</p>
                    <form method="post" action="{{ route('projectTasks.destroy', $projectTask->id) }}"
                          onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('delete')
                        <a class="taskEditing" href="{{ route('projectTasks.edit', $projectTask->id) }}"><i class="fa-solid fa-pencil"></i></a>
                        <button class="taskDelete" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <div class="taskInfo">
                <i class="fa-solid fa-info"></i>
                <p>General Info</p>
            </div>
            <div class="taskBody">
                <div class="taskSubtitle">
                    <div>
                        <p>Status:</p>
                        <p class="taskStatus">{{ $projectTask->status }}</p>
                    </div>
                    <div>
                        <p>Effort:</p>
                        <p class="taskEffort">{{ $projectTask->effort }}</p>
                    </div>
                    <div>
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
                        <p>{{ $projectTask->getUserNameById($projectTask->user_id) }}</p>
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
                        <p>Comments</p>
                    </div>
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
        </div>
    </div>
</div>


