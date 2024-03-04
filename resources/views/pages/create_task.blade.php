@include('helpers.header')

<div class="bg-modal">
    <div class="modal-content">
        <div class="close" id="close"><a href="{{ url('/') }}">+</a></div>
        <p>New Task</p>
        <form action="{{ route('post.created') }}" method="post">
            @csrf
            <div class="name"><input name="name" type="text" placeholder="Name"></div>
            <div class="attributes">
                <input name="status" type="text" placeholder="Status">
                <input name="effort" type="text" placeholder="Effort">
                <input name="priority" type="text" placeholder="Priority">
                <input name="timeEst" type="date" placeholder="Time Est.">
            </div>
            <div><input name="description" class="description" type="text" placeholder="Description"></div>
            <button class="createBtn">Create</button>
        </form>
    </div>
</div>
