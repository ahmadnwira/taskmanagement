@extends('layouts.master')

@section('content')
    <div class="col-sm-8">
        <form action="{{route('items.update', $item->id)}}" method="POST" class="mt-3">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description"
                    id="description" value="{{$item->description}}">
            </div>

            <button type="submit" class="btn btn-primary">update</button>
        </form>
        <br>
        @include('errors.errors')
    </div>
@endsection