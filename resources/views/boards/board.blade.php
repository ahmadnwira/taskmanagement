@extends('layouts.master') @section('content')

<div class="row mt-3">
    <div class="col-md-10">
        <div class="row mt-3">
            @foreach($lists as $list)
            <ul class="col-md-3">
                {{$list->items}}
            </ul>
            @endforeach
        </div>
    </div>

    <div class="col-md-2">
        <div class="col-md-2">
            <a href="{{route('lists.create', $board)}}" class="btn btn-primary">New List</a>
        </div>
    </div>
</div>
@endsection
