<div id="myModal" class="modal">
    <div class="modal-content2">
        <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">+</button>
        <p class="showMembersContent">Add or Remove project members</p>
        <label class="organizeMembersContent">Add members:</label>
        <form action="{{ route('projectUsers.store', $project->id) }}" method="post">
            <div class="modal-body">
                @csrf
                <input name="email" type="email" placeholder="User email">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>
            <button class="submit" type="submit">Add</button>
        </form>
        <label class="organizeMembersContent">Remove members:</label>
        <form action="{{ route('projectUsers.destroy', $project->id) }}" method="post">
            <div class="modal-body">
                @csrf
                <input name="email" type="email" placeholder="User email">
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
            </div>
            <button class="submit" type="submit">Remove</button>
        </form>
    </div>
</div>
