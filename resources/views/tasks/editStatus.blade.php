<x-app-layout>
<div class="max-w-7xl mx-auto mt-5 bg-gray-800 text-white p-8 rounded-lg">
  <h2 class="text-2xl font-bold mb-4">Update Status</h2>
  <form action="{{ url('/tasks/update/status/'.$task[0]->task_id) }}" method="post">
    @csrf
    @method('put')
    <div class="mb-4 text-black">
      <label for="status" class="block mb-1 text-white">Status:</label>
      <select name="status" id="status" class="w-full px-3 py-2 border rounded-md" required>
        <option value="pending" {{ $task[0]->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ $task[0]->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ $task[0]->status == 'completed' ? 'selected' : '' }}>Completed</option>
      </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Update Status</button>
  </form>
</div>
    <!-- <h4>Update status</h4>
<form action="{{ url('/tasks/update/status/'.$task[0]->task_id) }}" method="post">
@csrf
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
</form> -->
</x-app-layout>