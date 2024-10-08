<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('lara.css') }}" rel="stylesheet">
    <title>Laravel Training</title>
</head>
<body class="container">
    <div id="my-header">Header</div>
    <div>
        <a href="{{ url('/') }}" class="btn btn-dark">Utama</a>
        <a href="{{ url('/demo/greeting') }}" class="btn btn-dark">Greeting</a>
    </div>
    <div>
        Content
        @yield('body')
    </div>
    <div id="my-footer">Footer</div>
</body>
</html>
