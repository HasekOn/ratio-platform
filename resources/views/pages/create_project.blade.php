<dialog class="dialog">
    <div class="close" id="close">
        <button>+</button>
    </div>
    <h3 class="updateTask">New Project</h3>
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <div class="createTaskDiv">
            <div class="createTaskName">
                <p class="createTaskText">Name:</p>
                <input name="name" type="text" placeholder="Name..." class="createTaskInput">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>
            <div class="createProjectTaskAttributes">
                <div class="createTaskEffort">
                    <p class="createTaskText">Effort:</p>
                    <input name="effort" type="text" placeholder="Effort..." class="createTaskInput">
                </div>

                <div class="createTaskTimeEst">
                    <p class="createTaskText">Time Est:</p>
                    <input name="timeEst" type="date" placeholder="Time Est..." class="createTaskInput">
                    @error('timeEst')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                </div>
            </div>
            <div class="createTaskDescription">
                <p class="createTaskText">Description:</p>
                <div class="input-container">
                    <input name="description" class="description" type="text" placeholder="Description..."
                           id="text-area" oninput="updateCounter()" maxlength="1500">
                    <div id="counter">0/1500</div>
                </div>
                @error('description')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>

            <div class="createTaskBtnSave">
                <button class="submit">Create</button>
            </div>
        </div>
    </form>
</dialog>
