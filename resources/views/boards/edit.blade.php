@extends('layouts.master')

@section('content')
    <div class="col-sm-8">   
        <form action="{{route('boards.update', $board->id)}}" method="POST" class="mt-3">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$board->title}}">
            </div>

            <button type="submit" class="btn btn-primary">update</button>
        </form>
        <br>
        @include('errors.errors')
    </div>
@endsection