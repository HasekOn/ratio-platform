@extends('helpers.header')
@section('content')
    <body>
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close" id="close"><a href="{{ route('projects.index', $project->id) }}">+</a></div>
            <p>New Task</p>
            <form action="{{ route('projects.update', $project->id) }}" method="post">
                @csrf
                @method('put')
                <div class="name"><input name="name" type="text" value="{{ $project->name }}" placeholder="Name"></div>
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <div class="attributes">
                    <input name="effort" type="text" value="{{ $project->effort }}" placeholder="Effort">
                    <input name="timeEst" type="date" value="{{ $project->timeEst }}" placeholder="Time Est">
                </div>
                @error('timeEst')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <div><input name="description" class="description" type="text"
                            value="{{ $project->description }}" placeholder="Description"></div>
                @error('description')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <button class="createBtn">Update</button>
            </form>
        </div>
    </div>
    </body>
@endsection
