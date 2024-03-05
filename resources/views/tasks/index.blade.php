<form action="/tasks/create">
    <button type="submit">Add Task</button>
</form>

@foreach($tasks as $t)
<a href="{{ url('/tasks/view/'.$t->task_id) }}">
    <p>{{ $t->title }}</p>
    <p>{{ $t->description }}</p>
    <div>
        Assigned People:
        @foreach(json_decode($t->assigned) as $assign)
        <p>
            &#8226 {{ $assign }}
        </p>
        @endforeach
    </div>
</a>
@endforeach

<style>
    a{
        text-decoration: none;
    }
</style>