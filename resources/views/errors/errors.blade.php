
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        <li> {{ Session::get('error') }} </li>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <li> {{ Session::get('success') }} </li>
    </div>
@endif