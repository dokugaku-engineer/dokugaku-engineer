@extends('layouts.app')

@section('title', "${category} | 独学エンジニア")

@section('content')
<div class="p-blog__content clearfix">
    @include('partials.blog_breadcrumb')
    <main class="p-blog__main">
        <section class="p-blog-category">
            <h1 class="p-blog-category__title">{{ $category }}</h1>
        </section>
        @include('partials.blog_articles')
    </main>
    @include('partials.blog_sidebar')
</div>
@endsection
