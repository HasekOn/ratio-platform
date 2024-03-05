@extends('helpers.header')

@if($editing ?? false)
    @section('content')
        <div class="bg-modal">
            <div class="modal-content">
                <div class="close" id="close"><a href="{{ route('tasks.show', $task['id']) }}">+</a></div>
                <p>New Task</p>
                <form action="{{ route('tasks.update', $task['id']) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="name"><input name="name" type="text" value="{{$task['name']}}" placeholder="Name"></div>
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <div class="attributes">
                        <input name="status" type="text" value="{{$task['status']}}" placeholder="Status">
                        <input name="effort" type="text" value="{{$task['effort']}}" placeholder="Effort">
                        <input name="priority" type="text" value="{{$task['priority']}}" placeholder="Priority">
                        <input name="timeEst" type="date" value="{{$task['timeEst']}}" placeholder="Time Est">
                    </div>
                    @error('timeEst')
                    <span> {{ $message }}</span>
                    @enderror
                    <div><input name="description" class="description" type="text"
                                value="{{$task['description']}}" placeholder="Description"></div>
                    @error('description')
                    <span> {{ $message }}</span>
                    @enderror
                    <button class="createBtn">Create</button>
                </form>
            </div>
        </div>
    @endsection
@else
    @section('content')
        <body>
        <div class="boxTask">
            <div class="task">
                <p>{{ $task['name'] }}</p>
                <p>{{ $task['status'] }}</p>
                <p>{{ $task['effort'] }}</p>
                <p>{{ $task['priority'] }}</p>
                <p>{{ $task['timeEst'] }}</p>
                <p>{{ $task['description'] }}</p>
                <div>
                    <form method="POST" action="{{ route('tasks.destroy', $task['id']) }}">
                        @csrf
                        @method('delete')
                        <a href="{{ route('tasks.edit', $task['id']) }}">Edit</a>
                        <button class="delete">+</button>
                    </form>
                </div>
            </div>
        </div>
        </body>
    @endsection
@endif
