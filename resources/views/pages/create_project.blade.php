<dialog class="dialog">
    <div class="close" id="close">
        <button>+</button>
    </div>
            <label class="loginText">New Project</label><br>
            <form action="{{ route('projects.store') }}" method="post">
                @csrf
                <label class="loginText">Name:</label><br>
                <div class="name"><input name="name" type="text" placeholder="Name"></div>
                @error('name')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <label class="loginText">Attributes:</label><br>
                <div class="attributes">
                    <input name="effort" type="text" placeholder="Effort">
                    <input name="timeEst" type="date" placeholder="Time Est.">
                </div>
                @error('timeEst')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <label class="loginText">Description:</label><br>
                <div><input name="description" class="description" type="text" placeholder="Description" id="text-area">
                </div>
                @error('description')
                <span> {{ "[" . $message . "]" }}</span>
                @enderror
                <button class="submit">Create project</button>
            </form>
</dialog>
