<!DOCTYPE html>
<html lang='ja'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="twitter:card" content="summary_large_image">

    <link href="{{ asset('css/user.css') }}" rel="stylesheet">

    <title>
        @yield('title')
    </title>

    <script src="https://kit.fontawesome.com/381734123f.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts.header')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.footer')
</body>

</html>