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
        <h2 class="m-5 text-primary">BLOGS FROM API</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($data as $post)
                <div class="col">
                    <div class="card">
                        <img src="{{ $post->image_url }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">{{ $post->text }}</p>
                            <p class="btn btn-primary">
                                Likes <span class="badge badge-light">{{ $post->likes }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex m-5">
            {!! $data->links() !!}
        </div>
    </div>
</body>

</html>
