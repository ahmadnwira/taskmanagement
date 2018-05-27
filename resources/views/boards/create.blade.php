@extends('layouts.master')

@section('content')
    <div class="col-sm-8">   
        <form action="{{route('boards.store')}}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Board Title.">
            </div>

            <button type="submit" class="btn btn-primary">save</button>
        </form>
        <br>
        @include('errors.errors')
    </div>
@endsection