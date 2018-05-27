@extends('layouts.master')

@section('content')
    <div class="col-sm-8">   
        <form action="{{route('login.store')}}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
            </div>

            <div class="form-group">
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter username">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-secondary" href={{route('register.create')}}>Register</a>
            </div>
        </form>
        @include('errors.errors')
    </div>
@endsection