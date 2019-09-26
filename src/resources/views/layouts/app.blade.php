<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

        <meta name="twitter:card" content="summary_large_image">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <title>
            @yield('title')
        </title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
