<p>{{ $task->title }}</p>
<p>{{ $task->description }}</p>
<div>
    Assigned People:
    @foreach(json_decode($task->assigned) as $assign)
    <p>
        &#8226 {{ $assign }}
    </p>
    @endforeach
</div>
@auth
@if(auth()->user()->id == $task->id || auth()->user()->role == 'admin')
<div>
    <form action="{{ url('/tasks/edit/'.$task->task_id) }}">
        <button type="submit">UPDATE</button>
    </form>
    <form action="{{ url('/tasks/delete/'.$task->task_id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">DELETE</button>
    </form> 
</div>
@elseif(in_array(auth()->user()->name,json_decode($task->assigned)))
<div>
    <form action="{{ url('/tasks/edit/status/'.$task->task_id) }}" method="get">
        <button type="submit">UPDATE</button>
    </form>
</div>
@endif
@endauth
