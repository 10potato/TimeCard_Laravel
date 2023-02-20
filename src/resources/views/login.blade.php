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
        <!-- タイトル -->
        <title>{{ config('app.name') }}</title>
    </head>
    <body>

        <!-- ログインコンテンツエリア -->
        <div id="app" class="login">
            <form method="POST" action="" class="form-signin">
                {{ csrf_field() }}

                <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>

                <div class="row no-gutters align-items-center mb-2">
                    <div class="col">
                        <input type="text" name="email" class="form-control mb-2" placeholder="Eメール">
                        <input type="password" name="password" class="form-control" placeholder="パスワード">
                    </div>
                </div>

                <div class="error-message">
                @if (count($errors))
                    @foreach ($errors->all() as $error)
                        <span>{!! $error !!}</span>
                    @endforeach
                @endif
                </div>

                <div class="row no-gutters align-items-center justify-content-end mt-2">
                    <div class="col-4"></div><!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                    </div><!-- /.col -->
                    <div class="col-4"></div><!-- /.col -->
                </div>

            </form>
        </div>
    </body>
</html>
