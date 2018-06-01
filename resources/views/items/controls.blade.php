<div>
        <form action="{{route('items.destroy', $item->id)}}" method="POST">
            <a href="{{route('items.edit', $item->id)}}" class="btn btn-primary btn-sm">update</a>
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">Delete</a>
        </form>
    </div>