@extends('layouts.app')

@section('title', '独学エンジニア | 独学で自走できるエンジニアへ')

@section('content')
<div class="p-blog-hero"
    style="background-image:url('https://saruwakakun.com/wp-content/uploads/2017/06/dadadada-09-886x600.png');">
    <div class="p-blog-hero__cover">
        <div class="p-blog-hero__inner">
            <div class="p-blog-hero__category">
                <a href="">学習方法</a>
                <span>-</span>
                <a href="">学習方法</a>
            </div>
            <div class="p-blog-hero__title">
                head内に書くべきタグを総まとめ：SEO対策に有効なものは？
                <br>
                <a class="c-btn p-blog-hero_btn" href="">もっと読む</a>
            </div>
        </div>
    </div>
</div>
<div class="p-blog-content clearfix">
    <main class="p-blog-main">
        <div class="p-blog-article-list">
            <a href="" class="p-blog-article-list__article">
                <article class="p-blog-article-list__article-inner">
                    <img class="p-blog-article-list__article-image"
                        src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png" alt="">
                    <div class="p-blog-article-list__article-texts">
                        <h2 class="p-blog-article-list__article-title">
                            WEBサイトの仕組みを丁寧に基礎から学ぼう
                        </h2>
                        <div class="p-blog-article-list__article-date">
                            2019/09/22
                        </div>
                    </div>
                </article>
            </a>
            <a href="" class="p-blog-article-list__article">
                <article class="p-blog-article-list__article-inner">
                    <img class="p-blog-article-list__article-image"
                        src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png" alt="">
                    <div class="p-blog-article-list__article-texts">
                        <h2 class="p-blog-article-list__article-title">
                            WEBサイトの仕組みを丁寧に基礎から学ぼう
                        </h2>
                        <div class="p-blog-article-list__article-date">
                            2019/09/22
                        </div>
                    </div>
                </article>
            </a>
            <a href="" class="p-blog-article-list__article">
                <article class="p-blog-article-list__article-inner">
                    <img class="p-blog-article-list__article-image"
                        src="https://saruwakakun.com/wp-content/uploads/2017/05/gad-200x200.png" alt="">
                    <div class="p-blog-article-list__article-texts">
                        <h2 class="p-blog-article-list__article-title">
                            WEBサイトの仕組みを丁寧に基礎から学ぼう
                        </h2>
                        <time class="p-blog-article-list__article-date">
                            2019-09-22
                        </time>
                    </div>
                </article>
            </a>
        </div>
    </main>
    <aside class="p-blog-sidebar">
        <div class="p-blog-aside">
            <h4 class="p-blog-aside__title">書いている人</h4>
            <div class="p-blog-aside__writer clearfix">
                <img class="p-blog-aside__writer-img" src="{{ asset('images/profile.jpg') }}" alt="">
                <dl class="p-blog-aside__writer-profile">
                    <dt class="p-blog-aside__writer-name">山浦　清透</dt>
                    <dd class="p-blog-aside__writer-detail">
                        未経験からエンジニアに転向した経験を元に、プログラミングの学習方法や知っておきたいインターネットの知識をまとめています。
                    </dd>
                </dl>
            </div>
        </div>
    </aside>

</div>

{{-- @if (count($posts) > 0)
        @foreach ($posts as $post)
            <p>{{ $post->title }}</p>
<p>{{ $post->content }}</p>
@endforeach
@endif --}}
@endsection
