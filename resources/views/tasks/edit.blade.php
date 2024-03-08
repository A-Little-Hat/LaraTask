<x-app-layout>
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
                @foreach($category as $c)
                <div>
                  <input type="checkbox" id="{{$c->category_name	}}" name="category[]" value="{{$c->category_name	}}" />
                  <label for="{{$c->category_name	}}">{{$c->category_name	}}</label>
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
            <button type="submit">Update Task</button>
        </div>
    </div>
</form>
</x-app-layout>