@extends('layouts.app')

@section('title', '独学エンジニア | 独学で自走できるエンジニアへ')

@section('content')
<div class="p-blog-hero"
    style="background-image:url('https://saruwakakun.com/wp-content/uploads/2017/06/dadadada-09-886x600.png');">
    <div class="p-blog-hero__cover">
        <div class="p-blog-hero__inner">
            <div class="p-blog-hero__category">
                <a href="">学習方法</a>
                <span>&ensp;|&ensp;2019-09-22</span>
            </div>
            <div class="p-blog-hero__title">
                head内に書くべきタグを総まとめ：SEO対策に有効なものは？
                <br>
                <a class="c-btn p-blog-hero_btn" href="">もっと読む</a>
            </div>
        </div>
    </div>
</div>
<div class="p-blog__content clearfix">
    <main class="p-blog__main">
        @include('partials.blog_articles')
    </main>
    @include('partials.blog_sidebar')
</div>

{{-- @if (count($posts) > 0)
        @foreach ($posts as $post)
            <p>{{ $post->title }}</p>
<p>{{ $post->content }}</p>
@endforeach
@endif --}}
@endsection
