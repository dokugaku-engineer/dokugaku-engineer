@extends('layouts.app')

@section('title', '独学エンジニア | 独学で自走できるエンジニアへ')

@section('content')
    <div>Hoge</div>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <p>{{ $post->title }}</p>
            <p>{{ $post->content }}</p>
        @endforeach
    @endif
@endsection