@extends('layouts.app')

@section('title', "${category} | 独学エンジニア")

@section('content')
<nav>
    <ol class="p-blog-breadcrumb">
        <li>
            <i class="fa fa-map-marker fa-lg"></i>
            <span>ホーム</span>
        </li>
        <li><i class="fa fa-caret-right" aria-hidden="true"></i></li>
        <li>HTML</li>
    </ol>
</nav>
<div class="p-blog__content clearfix">
    @include('partials.blog_articles')
    @include('partials.blog_sidebar')
    {{-- <div>{{ $category }} --}}
</div>
@endsection
