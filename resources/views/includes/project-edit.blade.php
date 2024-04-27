@extends('helpers.header')
@section('content')
    <body>
    <div class="bg-modal">
        <div class="modal-content2">
            <div class="close" id="close"><a href="{{ route('projects.index', $project->id) }}">
                    <button>+</button>
                </a></div>
            <h3 class="updateTask">Edit Project</h3>
            <form action="{{ route('projects.update', $project->id) }}" method="post">
                @csrf
                @method('put')
                <div class="createTaskDiv">
                    <div class="createTaskName">
                        <p class="createTaskText">Name:</p>
                        <input name="name" type="text" placeholder="Name..." class="createTaskInput"
                               value="{{ $project->name }}">
                        @error('name')
                        <span> {{ "[" . $message . "]" }}</span>
                        @enderror
                    </div>
                    <div class="createProjectTaskAttributes">
                        <div class="createTaskEffort">
                            <p class="createTaskText">Effort:</p>
                            <input name="effort" type="text" placeholder="Effort..." class="createTaskInput"
                                   value="{{ $project->effort }}">
                        </div>

                        <div class="createTaskTimeEst">
                            <p class="createTaskText">Time Est:</p>
                            <input name="timeEst" type="date" placeholder="Time Est..." class="createTaskInput"
                                   value="{{ $project->timeEst }}">
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
                                   value="{{ $project->description }}">
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
    </body>
@endsection
