<div>
<form action="/category/add" method="post" >
@csrf
    <input type="text" name="category" id="category">
    <div>
        <button type="submit" >Add</button>
    </div>
</form>
</div>
<div>
    Categories:
@foreach($categories as $category)
<div>
    <form action="{{ url('/category/delete/'.$category->category_id) }}" method="post">
        @csrf
        @method('DELETE')
        <p>{{ $category->category_name }}</p>
        <button type="submit">X</button>
    </form>
</div>
@endforeach
</div>