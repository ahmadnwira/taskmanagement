<form class="mx-1" action="{{route('boards.destroy', $board->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    <a href="{{route('boards.edit', $board->id)}}" class="btn btn-sm btn-primary">Edit</a>
</form>