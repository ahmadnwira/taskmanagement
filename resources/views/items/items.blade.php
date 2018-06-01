<ul class="list-group">
    @foreach($list->items as $item)
        <li class="list-group-item text-dark my-1">
            {{$item->description}}
            @include('items.controls')
        </li>

    @endforeach
</ul>