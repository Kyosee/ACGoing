<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'ACGoing') - 攻城大凉皮的小博客</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <script src="{{ mix('/js/app.js') }}" charset="utf-8"></script>
        <script src="{{ mix('/js/passport.js') }}" charset="utf-8"></script>
    </head>
    <body>
        @include('layouts._header')
        <div class="container site-content">
            @yield('content')
        </div>
        @include('layouts._footer')
    </body>
</html>
