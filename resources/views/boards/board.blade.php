@extends('layouts.master') @section('content')

<div class="row mt-3">

    @include('errors.errors')

    <div class="col-md-10">

        <div class="row mt-3">

            @foreach($lists as $list)

                <div class="col-md-3 mx-1 text-light bg-dark">
                    <h3>{{$list->title}}</h3>

                    @if(auth()->id() === $board)
                        @include('lists.controls')
                    @endif

                    @include('lists.orderform')

                    <ul class="list-group">
                        @foreach($list->items as $item)
                            <li class="list-group-item text-dark my-1">{{$item->description}}</li>
                        @endforeach
                    </ul>

                </div>

            @endforeach

        </div>
    </div>

    <div class="col-md-2">
        <a href="{{route('lists.create', $board)}}" class="btn btn-primary">New List</a>
    </div>

</div>
@endsection
