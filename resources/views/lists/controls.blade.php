<div>
    
    <form action="{{route('lists.destroy', $list->id)}}" method="POST">
        <a href="{{route('lists.edit', $list->id)}}" class="btn btn-primary btn-sm">update</a>
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Delete</a>
    </form>
</div>