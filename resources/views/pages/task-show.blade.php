@extends('helpers.header')
@section('content')
    <body>
    @if($editing ?? false)
        <div class="bg-modal">
            <div class="modal-content2">
                <div class="close" id="close"><a href="{{ route('tasks.show', $task->id) }}">+</a></div>
                <p class="loginText">Edit Task</p>
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
                        <input name="status" type="text" value="{{ $task->status }}" placeholder="Status">
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
                    <button class="createBtn">Update</button>
                </form>
            </div>
        </div>
    @else
        @include('includes.one-task')
    @endif
    </body>
@endsection
