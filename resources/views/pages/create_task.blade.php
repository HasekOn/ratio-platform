<dialog class="dialog">
    <div class="close" id="close">
        <button>+</button>
    </div>
    <h3>Create Task</h3>
    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="name"><input name="name" type="text" placeholder="Name..." class="taskInput"></div>
        @error('name')
        <span> {{ "[" . $message . "]" }}</span>
        @enderror
        <div class="attributes">
            <select name="status">
                <option value="TO DO">TO DO</option>
                <option value="IN PROGRESS">IN PROGRESS</option>
                <option value="RETURNED">RETURNED</option>
                <option value="TO REVIEW">TO REVIEW</option>
                <option value="DONE">DONE</option>
                <option value="TO CANCEL">TO CANCEL</option>
            </select>
            <input class="taskInput" name="effort" type="text" placeholder="Effort...">
            <input class="taskInput" name="priority" type="text" placeholder="Priority...">
            <input class="taskInput" name="timeEst" type="date" placeholder="Time Est...">
        </div>
        @error('timeEst')
        <span> {{ "[" . $message . "]" }}</span>
        @enderror
        <div><input name="description" class="description" type="text" placeholder="Description..." id="text-area">
        </div>
        @error('description')
        <span> {{ "[" . $message . "]" }}</span>
        @enderror
        <button class="submit">Create</button>
    </form>
</dialog>
