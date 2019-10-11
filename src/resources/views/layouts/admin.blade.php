<!DOCTYPE html>
<html lang='ja'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <title>
        @yield('title')
    </title>

    <script src="https://kit.fontawesome.com/381734123f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3>
                    管理画面
                </h3>
            </div>

            <ul class="nav sidebar-nav">
                <li>
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fa fa-diamond"></i>
                        <span class="nav-label">ブログ記事</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fa fa-diamond"></i>
                        <span class="nav-label">カテゴリー</span>
                    </a>
                </li>
            </ul>
        </nav>
        <main class="container-fluid page-wrapper">
            @yield('content')
        </main>
    </div>

</body>

</html>
