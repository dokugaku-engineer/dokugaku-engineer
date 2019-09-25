<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <body>
        <div>Hoge</div>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <p>{{ $post->title }}</p>
                <p>{{ $post->content }}</p>
            @endforeach
        @endif
    </body>
</html>
