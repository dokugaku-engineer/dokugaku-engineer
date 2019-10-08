@extends('layouts.app')

@section('title', '記事詳細 | 独学エンジニア')

@section('content')
<div class="p-blog__content clearfix">
    <div class="p-blog-breadcrumb__wrap">
        @include('partials.blog_breadcrumb')
    </div>
    <main class="p-post__main">
        <header class="p-post__header">
            <div class="p-post__metadata">
                <i class="fas fa-clock fa-lg"></i>
                <time>
                    2019-09-22
                </time>
            </div>
            <h1 class="p-post__title">おしゃれなアイキャッチ画像の作り方＆デザインのコツ8つ</h1>
        </header>
        <div class="p-post__hero">
            <img src="https://saruwakakun.com/wp-content/uploads/2017/07/eyecatch-min-911x600.png" alt="">
        </div>
        <div class="p-post__content">
            <p>最初は概念的な話になるのでモヤモヤが残るかもしれませんが、読み進めることで理解が深まっていくと思うので焦らず１つずつ理解を積み重ねていきましょう。</p>
            <nav class="p-post__contents">
                <div class="p-post__contents-header">
                    <i class="fas fa-th-list"></i>
                    <span>記事の目次</span>
                </div>
                <ol class="p-post__contents-list">
                    <li><a href="">パンくずリストとは？</a></li>
                    <li><a href="">パンくずリストとは？</a></li>
                </ol>
            </nav>
            <h2>パンくずリストとは？</h2>
            <p>
                パンくずリストとは「<strong>現在見ているページがwebサイトのどの階層にいるのかを表す道しるべ</strong>」です。パンくずリストはそのwebサイトのサイトマップ（サイトの階層構造）にもとづいて表されていてます。
            </p>
            <h3>パンくずリストの由来</h3>
            <img class="" src="https://webliker.info/wp-content/uploads/2018/09/hansel-and-gretel.jpg" alt="">
            <p>さて、「パンくずの道しるべ」と聞くとある童話を思い出しますね。</p>
            <h4>ダウンロードができたら…</h4>
            <p>ダウンロードしたものは、Google Chromeのインストール用のファイルです。このファイルを開いて、インストールをしましょう。
            </p>
            <p>ダウンロードしたものは、Google Chromeのインストール用のファイルです。このファイルを開いて、インストールをしましょう。
            </p>
            <h2>パンくずリストとは？</h2>
            <h3>パンくずリストの由来</h3>
            <p>さて、「パンくずの道しるべ」と聞くとある童話を思い出しますね。</p>
        </div>
    </main>
    @include('partials.blog_sidebar')
</div>
@endsection
