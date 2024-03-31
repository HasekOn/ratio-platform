<dialog class="dialog">
    <div class="bg-modal">
        <div class="modal-content2">
            <div class="close" id="close">
                <button autofocus>+</button>
            </div>
            <p class="loginText">Create Task</p>
            <form action="{{ route('project.task.store', $project->id) }}" method="post">
                @csrf
                <div class="name"><input name="name" type="text" placeholder="Name"></div>
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <div class="attributes">
                    <input name="status" type="text" placeholder="Status">
                    <input name="effort" type="text" placeholder="Effort">
                    <input name="priority" type="text" placeholder="Priority">
                    <input name="timeEst" type="date" placeholder="Time Est.">
                </div>
                @error('timeEst')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <div><input name="description" class="description" type="text" placeholder="Description" id="text-area">
                </div>
                @error('description')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <button class="createBtn">Create</button>
            </form>
        </div>
    </div>
</dialog>
