@extends('layouts.master')

@section('content')

    <div class="row mt-3">
        @foreach($lists as $list)
            <ul class="col-md-3">
                {{$list->items}}
            </ul>
        @endforeach  

    </div>
@endsection