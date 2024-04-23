@extends('helpers.header')

@section('title', $task->name)
@section('content')
    <body>
    @if($editing ?? false)
        <div class="bg-modal">
            <div class="modal-content2">
                <div class="close" id="close"><a href="{{ route('tasks.show', $task->id) }}"><button>+</button></a></div>
                <h3 class="loginText">Edit Task</h3>
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @csrf
                    @method('put')
                    <label class="loginText">Name:</label><br>
                    <div class="name"><input name="name" type="text" value="{{ $task->name }}" placeholder="Name"></div>
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <label class="loginText">Attributes:</label><br>
                    <div class="attributes">
                        <select name="status" class="select">
                            <option value="TO DO" {{ $task->status == 'TO DO' ? 'selected' : '' }}>TO DO</option>
                            <option value="In PROGRESS" {{ $task->status == 'IN PROGRESS' ? 'selected' : '' }}>IN
                                PROGRESS
                            </option>
                            <option value="TO REVIEW" {{ $task->status == 'TO REVIEW' ? 'selected' : '' }}>TO REVIEW
                            </option>
                            <option value="RETURNED" {{ $task->status == 'RETURNED' ? 'selected' : '' }}>RETURNED
                            </option>
                            <option value="DONE" {{ $task->status == 'DONE' ? 'selected' : '' }}>DONE</option>
                            <option value="TO CANCEL" {{ $task->status == 'TO CANCEL' ? 'selected' : '' }}>TO CANCEL
                            </option>
                        </select>
                        <input name="effort" type="text" value="{{ $task->effort }}" placeholder="Effort">
                        <input name="priority" type="text" value="{{ $task->priority }}" placeholder="Priority">
                        <input name="timeEst" type="date" value="{{ $task->timeEst }}" placeholder="Time Est">
                    </div>

                    @error('timeEst')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <div>
                        <label class="loginText">Description:</label><br>
                        <input name="description" class="description" type="text"
                               value="{{ $task->description }}" placeholder="Description">
                    </div>
                    @error('description')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button class="submit">Update</button>
                </form>
            </div>
        </div>
    @else
        @include('includes.one-task')
    @endif
    </body>
@endsection
