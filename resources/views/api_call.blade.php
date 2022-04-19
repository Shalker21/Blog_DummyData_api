<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">

    <script src="/js/app.js"></script>

    <style>

        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('api_call') }}" method="get">
            <button type="submit" class="btn btn-primary py-4 px-2">STORE DATA</button>
        </form>
    </div>
</body>

</html>