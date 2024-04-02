<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content2">
            <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">+</button>
            <p class="loginText">Add or Remove project members</p>
            <label class="loginText">Add members:</label><br>
            <div class="modal-body">
                <form action="{{ route('projectUsers.store', $project->id) }}" method="post">
                    @csrf
                    <input name="email" type="email" placeholder="User email">
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button class="createBtn" type="submit">Add</button>
                </form>
            </div>
            <label class="loginText">Remove members:</label><br>
            <div class="modal-body">
                <form action="{{ route('projectUsers.destroy', $project->id) }}" method="post">
                    @csrf
                    <input name="email" type="email" placeholder="User email">
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button class="createBtn" type="submit">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>
