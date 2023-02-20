<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- css -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet">
        @yield('css')
        <!-- タイトル -->
        <title>{{$title}}</title>
    </head>
    <body>
        <div id="app" class="app">
            @yield('content')
        </div>

        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>
