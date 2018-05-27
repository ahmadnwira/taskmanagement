<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <title>Flow</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Home</a>

            @if(Auth::check())
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" > welcome, {{Auth::user()->name}} </a>
                </li>
 
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
            @endif
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>
