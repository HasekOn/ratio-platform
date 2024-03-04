@include('helpers.header')

<body>
<div class="box">
    <ul class = "taskMenu">
        <li><a href="{{ url('/') }}">Inbox</a></li>
        <li>To Do</li>
        <li>Done</li>
        <li><a href="{{ url('/create-task') }}">New Task</a></li>
    </ul>
    <div class="boxTask">
        @foreach($tasks as $task)
            <div class="task">
                <p>{{ $task->name }}</p>
                <p>{{ $task->status }}</p>
                <p>{{ $task->timeEst }}</p>
            </div>
        @endforeach
    </div>
</div>
</body>
