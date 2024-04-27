<dialog class="dialog">
    <div class="close" id="close">
        <button>+</button>
    </div>
    <h3 class="updateTask">Create Task</h3>
    <form action="{{ route('projects.tasks.store', $project->id) }}" method="post">
        @csrf
        <div class="createTaskDiv">
            <div class="createTaskName">
                <p class="createTaskText">Name:</p>
                <input name="name" type="text" placeholder="Name..." class="createTaskInput">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>
            <div class="createTaskAttributes">
                <div class="createTaskStatus">
                    <p class="createTaskText">Status:</p>
                    <select name="status" class="createTaskSelect">
                        <option value="TO DO">TO DO</option>
                        <option value="IN PROGRESS">IN PROGRESS</option>
                        <option value="RETURNED">RETURNED</option>
                        <option value="TO REVIEW">TO REVIEW</option>
                        <option value="DONE">DONE</option>
                        <option value="TO CANCEL">TO CANCEL</option>
                    </select>
                </div>

                <div class="createTaskEffort">
                    <p class="createTaskText">Effort:</p>
                    <input name="effort" type="text" placeholder="Effort..." class="createTaskInput">
                </div>

                <div class="createTaskPriority">
                    <p class="createTaskText">Priority:</p>
                    <input name="priority" type="text" placeholder="Priority..." class="createTaskInput">
                </div>

                <div class="createTaskTimeEst">
                    <p class="createTaskText">Time Est:</p>
                    <input name="timeEst" type="date" placeholder="Time Est..." class="createTaskInput">
                    @error('timeEst')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                </div>
            </div>

            <div class="createTaskAssignee">
                <div class="createTaskStatus">
                    <p class="createTaskText">Assignee:</p>
                    <select name="assignee" class="createTaskSelect">
                        <option value="">Unassign member</option>
                        @foreach($usersProject as $userProject)
                            @foreach($projects as $project)
                                <option
                                    value="{{ $userProject->user_id }}">{{ $project->getUserNameById($userProject->user_id) }}</option>
                                <option
                                    value="{{ $project->creator_id }}">{{ $project->getUserNameById($project->creator_id) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="createTaskDescription">
                <p class="createTaskText">Description:</p>
                <div class="input-container">
                    <input name="description" class="description" type="text" placeholder="Description..."
                           id="text-area" oninput="updateCounter()" maxlength="1500">
                    <div id="counter">0/1500</div>
                </div>
                @error('description')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>

            <div class="createTaskBtnSave">
                <button class="submit">Create</button>
            </div>
        </div>
    </form>
</dialog>
