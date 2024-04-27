@extends('helpers.header')

@section('title', 'Project task')
@section('content')
    <body>
    @if($editing ?? false)
        <div class="bg-modal">
            <div class="modal-content2">
                <div class="close" id="close"><a href="{{ route('projectTasks.show', $projectTask->id) }}">
                        <button>+</button>
                    </a></div>
                <h3 class="updateTask">Edit Task</h3>
                <form action="{{ route('projectTasks.update', $projectTask->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="createTaskDiv">
                        <div class="createTaskName">
                            <p class="createTaskText">Name:</p>
                            <input name="name" type="text" placeholder="Name..." class="createTaskInput"
                                   value="{{ $projectTask->name }}">
                            @error('name')
                            <span> {{ "[" . $message . "]" }}</span>
                            @enderror
                        </div>
                        <div class="createTaskAttributes">
                            <div class="createTaskStatus">
                                <p class="createTaskText">Status:</p>
                                <select name="status" class="createTaskSelect">
                                    <option value="TO DO" {{ $projectTask->status == 'TO DO' ? 'selected' : '' }}>TO DO
                                    </option>
                                    <option
                                        value="In PROGRESS" {{ $projectTask->status == 'IN PROGRESS' ? 'selected' : '' }}>
                                        IN
                                        PROGRESS
                                    </option>
                                    <option
                                        value="TO REVIEW" {{ $projectTask->status == 'TO REVIEW' ? 'selected' : '' }}>TO
                                        REVIEW
                                    </option>
                                    <option value="RETURNED" {{ $projectTask->status == 'RETURNED' ? 'selected' : '' }}>
                                        RETURNED
                                    </option>
                                    <option value="DONE" {{ $projectTask->status == 'DONE' ? 'selected' : '' }}>DONE
                                    </option>
                                    <option
                                        value="TO CANCEL" {{ $projectTask->status == 'TO CANCEL' ? 'selected' : '' }}>TO
                                        CANCEL
                                    </option>
                                </select>
                            </div>

                            <div class="createTaskEffort">
                                <p class="createTaskText">Effort:</p>
                                <input name="effort" type="text" placeholder="Effort..." class="createTaskInput"
                                       value="{{ $projectTask->effort }}">
                            </div>

                            <div class="createTaskPriority">
                                <p class="createTaskText">Priority:</p>
                                <input name="priority" type="text" placeholder="Priority..." class="createTaskInput"
                                       value="{{ $projectTask->priority }}">
                            </div>

                            <div class="createTaskTimeEst">
                                <p class="createTaskText">Time Est:</p>
                                <input name="timeEst" type="date" placeholder="Time Est..." class="createTaskInput"
                                       value="{{ $projectTask->timeEst }}">
                                @error('timeEst')
                                <span> {{ "[" . $message . "]" }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="createTaskAssignee">
                            <div class="createTaskStatus">
                                <p class="createTaskText">Assignee:</p>
                                <select name="assignee" class="createTaskSelect">
                                    @if($projectTask->assignee)
                                        <option
                                            value="{{ $projectTask->assignee }}">{{ $projectTask->getUserNameById($projectTask->assignee) }}</option>
                                        <option value="">Unassign member</option>
                                        @foreach($usersProject as $userProject)
                                            @foreach($projects as $project)
                                                <option
                                                    value="{{ $userProject->user_id }}">{{ $projectTask->getUserNameById($userProject->user_id) }}</option>
                                                <option
                                                    value="{{ $project->creator_id }}">{{ $projectTask->getUserNameById($project->creator_id) }}</option>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <option value="">Unassign member</option>
                                        @foreach($usersProject as $userProject)
                                            @foreach($projects as $project)
                                                <option
                                                    value="{{ $userProject->user_id }}">{{ $projectTask->getUserNameById($userProject->user_id) }}</option>
                                                <option
                                                    value="{{ $project->creator_id }}">{{ $projectTask->getUserNameById($project->creator_id) }}</option>
                                            @endforeach
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="createTaskDescription">
                            <p class="createTaskText">Description:</p>
                            <div class="input-container">
                                <input name="description" class="description" type="text" placeholder="Description..."
                                       id="text-area" oninput="updateCounter()" maxlength="1500"
                                       value="{{ $projectTask->description }}">
                                <div id="counter">0/1500</div>
                            </div>
                            @error('description')
                            <span> {{ "[" . $message . "]" }}</span>
                            @enderror
                        </div>

                        <div class="createTaskBtnSave">
                            <button class="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        @include('includes.one-projectTask')
    @endif
    </body>
    @include('scripts.scripts')
@endsection
