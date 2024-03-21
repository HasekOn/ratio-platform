<div id="myModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">+</button>
            <div class="modal-body">
                <form action="{{ route('user.add', $project->id) }}" method="post">
                    @csrf
                    <p>Add member</p>
                    <input name="name" type="text" placeholder="Name">
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button type="submit">Add</button>
                </form>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.remove', $project->id) }}" method="post">
                    @csrf
                    <p>Remove member</p>
                    <input name="name" type="text" placeholder="Name">
                    @error('name')
                    <span> {{ "[" . $message . "]" }}</span>
                    @enderror
                    <button type="submit">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>
