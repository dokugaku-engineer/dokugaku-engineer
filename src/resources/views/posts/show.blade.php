@extends('layouts.app')

@section('title', '記事詳細 | 独学エンジニア')

@section('content')
<div class="p-blog__content clearfix">
    @include('partials.blog_breadcrumb')
    <main class="p-blog__main">
    </main>
    @include('partials.blog_sidebar')
</div>
@endsection
