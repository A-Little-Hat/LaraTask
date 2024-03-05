<h4>Update status</h4>
<form action="{{ url('/tasks/edit/status/'.$task[0]->task_id) }}" method="post">
@csrf <!-- CSRF Protection -->
@method('put')
    <div class="h-screen">
        <div class="m-10">
            <label for="status">status</label> <br>
            <select name="status" id="status" required>
                <option value="pending" selected>pending</option>
                <option value="in_progress">in_progress</option>
                <option value="completed">completed</option>
            </select>
        </div>
        <div class="m-10">
            <button type="submit">Update Task</button>
        </div>
    </div>
</form>