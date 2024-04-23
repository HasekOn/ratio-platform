<div class="boxPage">
    <div class="boxTaskPage">
        <div class="bigTask">
            <div class="taskHeader">
                <div>
                    <p class="taskName">{{ $task->name }}</p>
                </div>
                <div class="taskUpdate">
                    <p>Last Updated: {{ \Carbon\Carbon::parse($task->updated_at)->diffForHumans()}}</p>
                        <form method="post" action="{{ route('tasks.destroy', $task->id) }}"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('delete')
                            <a class="taskEditing" href="{{ route('tasks.edit', $task->id) }}"><i class="fa-solid fa-pencil"></i></a>
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
                        <p class="taskStatus">{{ $task->status }}</p>
                    </div>
                    <div>
                        <p>Effort:</p>
                        <p class="taskEffort">{{ $task->effort }}</p>
                    </div>
                    <div>
                        <p>Priority:</p>
                        <p class="taskPriority">{{ $task->priority }}</p>
                    </div>
                    <div>
                        <div class="taskDate">
                            <i class="fa-regular fa-calendar"></i>
                            <p>Complete by:</p>
                        </div>
                        <p>{{ $task->timeEst }}</p>
                    </div>
                </div>
                <div class="taskDescription">
                    <div class="taskDescriptionHeader">
                        <i class="fa-regular fa-newspaper"></i>
                        <p>Description:</p>
                    </div>
                    <p>{{ $task->description }}</p>
                </div>

                <div class="taskComments">
                    <div class="taskCommentsHeader">
                        <i class="fa-solid fa-comments"></i>
                        <p>Comments</p>
                    </div>
                    @forelse($task->comments as $comment)
                        {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i') }} -
                        {{ $comment->content }}
                        | {{ \Carbon\Carbon::parse($comment->created_at)->format('M-d') }} |
                        <br>
                    @empty
                        <p>No comment found</p>
                    @endforelse
                    <div class="singleTask">
                        <form method="post" action="{{ route('tasks.comments.store', $task->id) }}">
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

