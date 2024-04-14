@extends('helpers.header')

@section('title', 'Project task')
@section('content')
    <body>
    @if($editing ?? false)
        <div class="bg-modal">
            <div class="modal-content2">
                <div class="close" id="close"><a href="{{ route('projectTasks.show', $projectTask->id) }}">+</a></div>
                <p class="loginText">Edit Task</p>
                <form action="{{ route('projectTasks.update', $projectTask->id) }}" method="post">
                    @csrf
                    @method('put')
                    <label class="loginText">Name:</label><br>
                    <div class="name"><input name="name" type="text" value="{{ $projectTask->name }}"
                                             placeholder="Name"></div>
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <label class="loginText">Attributes:</label><br>
                    <div class="attributes">
                        <select name="status" class="select">
                            <option value="TO DO" {{ $projectTask->status == 'TO DO' ? 'selected' : '' }}>TO DO</option>
                            <option value="In PROGRESS" {{ $projectTask->status == 'IN PROGRESS' ? 'selected' : '' }}>IN
                                PROGRESS
                            </option>
                            <option value="TO REVIEW" {{ $projectTask->status == 'TO REVIEW' ? 'selected' : '' }}>TO
                                REVIEW
                            </option>
                            <option value="RETURNED" {{ $projectTask->status == 'RETURNED' ? 'selected' : '' }}>
                                RETURNED
                            </option>
                            <option value="DONE" {{ $projectTask->status == 'DONE' ? 'selected' : '' }}>DONE</option>
                            <option value="TO CANCEL" {{ $projectTask->status == 'TO CANCEL' ? 'selected' : '' }}>TO
                                CANCEL
                            </option>
                        </select>
                        <input name="effort" type="text" value="{{ $projectTask->effort }}" placeholder="Effort">
                        <input name="priority" type="text" value="{{ $projectTask->priority }}" placeholder="Priority">
                        <input name="timeEst" type="date" value="{{ $projectTask->timeEst }}" placeholder="Time Est">
                    </div>
                    @error('timeEst')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <div>
                        <label class="loginText">Description:</label><br>
                        <input name="description" class="description" type="text"
                               value="{{ $projectTask->description }}" placeholder="Description">
                    </div>
                    @error('description')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button class="createBtn">Update</button>
                </form>
            </div>
        </div>
    @else
        @include('includes.one-projectTask')
    @endif
    </body>
    @include('scripts.scripts')
@endsection
