<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Store</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div id="app">
            <h1>hello</h1>
            <contacts></contacts>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
