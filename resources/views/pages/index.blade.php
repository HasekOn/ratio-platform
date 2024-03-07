@extends('helpers.header')

@section('content')
    <body>
    <div class="box">
        <ul class="taskMenu">
            <li><a href="{{ url('/') }}">Inbox</a></li>
            <li>To Do</li>
            <li>Done</li>
        </ul>
        @include('pages.create_task')
        <button>Show the dialog</button>
        <div class="boxTask">
            <div class="search">
                <h5>Search</h5>
                <form action="{{ route('ratio.home') }}" method="GET">
                    <input class="searchBar" placeholder="..." type="text" name="search">
                    <button class="searchButton">Search</button>
                </form>
            </div>
            @foreach($tasks as $task)
                @include('includes.task-card')
            @endforeach
        </div>
    </div>
    </body>

    <script>
        const dialog = document.querySelector("dialog");
        const showButton = document.querySelector("dialog + button");
        const closeButton = document.querySelector("dialog button");

        showButton.addEventListener("click", () => {
            dialog.showModal();
        });

        closeButton.addEventListener("click", () => {
            dialog.close();
        });
    </script>
@endsection
