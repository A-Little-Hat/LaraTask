<x-app-layout>
<div class="max-w-7xl mx-auto mt-5 bg-gray-800 text-white p-8 rounded-lg">
  <h2 class="text-2xl font-bold mb-4">Add Task</h2>
  <form action="/tasks/create" method="post">
    @csrf 
    <div class="mb-4">
      <label for="title" class="block mb-1">Title:</label>
      <input type="text" name="title" id="title" class="text-black w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
      <label for="description" class="block mb-1">Description:</label>
      <textarea name="description" id="description" class="text-black w-full px-3 py-2 border rounded-md" required></textarea>
    </div>
    <div class="mb-4">
      <label for="dueDate" class="block mb-1">Due Date:</label>
      <input type="date" name="dueDate" id="dueDate" class="text-black w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-4">
      <label for="status" class="block mb-1">Status:</label>
      <select name="status" id="status" class="text-black w-full px-3 py-2 border rounded-md" required>
        <option value="pending" selected>Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="category" class="block mb-1">Category:</label>
      @foreach($category as $c)
      <div class="inline-block mr-2">
        <input type="checkbox" id="category_{{$c->category_name}}" name="category[]" value="{{$c->category_name}}" class="mr-1">
        <label for="category_{{$c->category_name}}">{{$c->category_name}}</label>
      </div>
      @endforeach
    </div>
    <div class="mb-4">
      <label for="assigned" class="block mb-1">Assigned To:</label>
      @foreach($username as $name)
      <div class="inline-block mr-2">
        <input type="checkbox" id="assigned_{{$name->name}}" name="assigned[]" value="{{$name->name}}" class="mr-1">
        <label for="assigned_{{$name->name}}">{{$name->name}}</label>
      </div>
      @endforeach
    </div>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Add Task</button>
  </form>
</div>
    <!-- <div class="text-white w-full flex justify-center" >

        <h4>Add Task</h4>
        <form action="/tasks/create" method="post">
        @csrf
            <div class="h-screen">
                <div class="m-10">
                    <label for="title">title</label><br>
                    <input class="text-black" type="text" name="title" id="title"/>
                </div>
                <div class="m-10">
                    <label for="description">description</label> <br>
                    <textarea class="text-black" type="textarea" name="description" id="description"></textarea>
                </div>
                <div class="m-10">
                    <label for="dueDate">due Date</label> <br>
                    <input class="text-black" type="date" name="dueDate" id="dueDate"></input>
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
                        <legend class="" >Choose category:</legend>
                        @foreach($category as $c)
                        <div>
                          <input type="checkbox" id="{{$c->category_name}}" name="category[]" value="{{$c->category_name	}}" />
                          <label for="{{$c->category_name}}">{{$c->category_name	}}</label>
                        </div>
                        @endforeach
                    </fieldset>
                </div>
                <div class="m-10">
                    <fieldset>
                        <legend>Assign users:</legend>
                        @foreach($username as $name)
                        <div>
                          <input type="checkbox" id="{{ $name->name }}" name="assigned[]" value="{{ $name->name }}" />
                          <label for="{{ $name->name }}">{{ $name->name }}</label>
                        </div>
                        @endforeach
                      </fieldset>
                </div>
                <div class="m-10">
                    <button type="submit">Add Task</button>
                </div>
            </div>
        </form>
    </div> -->
</x-app-layout>