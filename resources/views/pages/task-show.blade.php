@extends('helpers.header')

@section('title', $task->name)
@section('content')
    <body>
    @if($editing ?? false)
        <div class="bg-modal">
            <div class="modal-content2">
                <div class="close" id="close"><a href="{{ route('tasks.show', $task->id) }}">
                        <button>+</button>
                    </a></div>
                <h3 class="updateTask">Edit Task</h3>
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="createTaskDiv">
                        <div class="createTaskName">
                            <p class="createTaskText">Name:</p>
                            <input name="name" type="text" placeholder="Name..." class="createTaskInput"
                                   value="{{ $task->name }}">
                            @error('name')
                            <span> {{ "[" . $message . "]" }}</span>
                            @enderror
                        </div>
                        <div class="createTaskAttributes">
                            <div class="createTaskStatus">
                                <p class="createTaskText">Status:</p>
                                <select name="status" class="createTaskSelect">
                                    <option value="TO DO" {{ $task->status == 'TO DO' ? 'selected' : '' }}>TO DO
                                    </option>
                                    <option value="In PROGRESS" {{ $task->status == 'IN PROGRESS' ? 'selected' : '' }}>
                                        IN
                                        PROGRESS
                                    </option>
                                    <option value="TO REVIEW" {{ $task->status == 'TO REVIEW' ? 'selected' : '' }}>TO
                                        REVIEW
                                    </option>
                                    <option value="RETURNED" {{ $task->status == 'RETURNED' ? 'selected' : '' }}>
                                        RETURNED
                                    </option>
                                    <option value="DONE" {{ $task->status == 'DONE' ? 'selected' : '' }}>DONE</option>
                                    <option value="TO CANCEL" {{ $task->status == 'TO CANCEL' ? 'selected' : '' }}>TO
                                        CANCEL
                                    </option>
                                </select>
                            </div>

                            <div class="createTaskEffort">
                                <p class="createTaskText">Effort:</p>
                                <input name="effort" type="text" placeholder="Effort..." class="createTaskInput"
                                       value="{{ $task->effort }}">
                            </div>

                            <div class="createTaskPriority">
                                <p class="createTaskText">Priority:</p>
                                <input name="priority" type="text" placeholder="Priority..." class="createTaskInput"
                                       value="{{ $task->priority }}">
                            </div>

                            <div class="createTaskTimeEst">
                                <p class="createTaskText">Time Est:</p>
                                <input name="timeEst" type="date" placeholder="Time Est..." class="createTaskInput"
                                       value="{{ $task->timeEst }}">
                                @error('timeEst')
                                <span> {{ "[" . $message . "]" }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="createTaskDescription">
                            <p class="createTaskText">Description:</p>
                            <div class="input-container">
                                <input name="description" class="description" type="text" placeholder="Description..."
                                       id="text-area" oninput="updateCounter()" maxlength="1500"
                                       value="{{ $task->description }}">
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
        @include('includes.one-task')
    @endif
    </body>
@endsection
