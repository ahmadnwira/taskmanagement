<form action="{{route('lists.move', $list->id)}}" method='POST' class="form-inline">
    @method('put')
    @csrf
    <select name="order" class="input-group my-2">

        <option>{{$list->order}}</option>
        @for($i=1; $i<=sizeof($lists); $i++)
            <option>{{$i}}</option>
        @endfor

    </select>

    <button type="submit" class="btn btn-sm btn-primary mx-1">move</button>
</form>