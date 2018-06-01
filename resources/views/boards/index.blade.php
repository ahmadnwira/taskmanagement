@extends('layouts.master')

@section('content')
    <div class="row mt-3">
        <span class="m-1"><a href="{{route('home')}}">Personal Boards</a></span>
        <span class="m-1"><a href="{{route('boards.shared')}}">Shared with you</a></span>
    </div>

    @include('errors.errors')

    <div class="row mt-1">

        <div class="col-md-10">
            <div class="row">
                    @foreach($boards as $board)
                    <div class="col-sm-3 col-md-4 mx-1 bg-dark card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a class="text-white" href="/boards/{{$board->id}}">{{$board->title}}</a>
                            </h5>
                        </div>

                        @if(auth()->id() === $board->user_id)
                            @include('boards.controlsform');
                            <hr>
                            @include('boards.shareform')
                        @endif
                    </div>
                @endforeach

            </div>

        </div>

        <div class="col-md-2">
            <a class="btn btn-primary" href="{{route('boards.create')}}">New Board</a>
        </div>
    </div>
@endsection