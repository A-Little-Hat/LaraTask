<h4>Update Task</h4>
<form action="{{ url('/tasks/edit/'.$task[0]->task_id) }}" method="post">
@csrf <!-- CSRF Protection -->
@method('put')

    <div class="h-screen">
        <div class="m-10">
            <label for="title">title</label><br>
            <input class="text-black" type="text" name="title" id="title" value="{{ $task[0]->title }}" />
        </div>
        <div class="m-10">
            <label for="description">description</label> <br>
            <textarea class="text-black" type="textarea" name="description" id="description"></textarea>
        </div>
        <div class="m-10">
            <label for="dueDate">due Date</label> <br>
            <input class="text-black" type="date" name="dueDate" id="dueDate" ></input>
        </div>
        <div class="m-10">
            <label for="status">status</label> <br>
            <select name="status" id="status" required>
                <option value="pending" selected>pending</option>
                <option value="in_progress">in_progress</option>
                <option value="completed">completed</option>
            </select>
        </div>
        <div class="m-10">
            <fieldset>
                <legend>Choose category:</legend>
                <div>
                  <input type="checkbox" id="database" name="category[]" value="database" />
                  <label for="database">database</label>
                </div>
                <div>
                  <input type="checkbox" id="network" name="category[]" value="network" />
                  <label for="network">network</label>
                </div>
              </fieldset>
        </div>
        <div class="m-10">
            <fieldset>
                <legend>Assign users:</legend>
                <div>
                  <input type="checkbox" id="bishal" name="assigned[]" value="bishal" />
                  <label for="bishal">bishal</label>
                </div>
                <div>
                  <input type="checkbox" id="soumya" name="assigned[]" value="soumya" />
                  <label for="soumya">soumya</label>
                </div>
              </fieldset>
        </div>
        <div class="m-10">
            <button type="submit">Update Task</button>
        </div>
    </div>
</form>