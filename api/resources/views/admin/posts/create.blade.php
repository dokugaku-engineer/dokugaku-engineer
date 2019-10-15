@extends('layouts.admin')

@section('title', "ブログ記事作成")

@section('content')
<div class="row page-heading">
    <div class="col-lg-10">
        <h1 class="">ブログの新規作成</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-title">
                <h4>新規作成</h5>
            </div>
            <div class="box-content">
                @include('admin.posts.partials.form', [
                'method' => 'POST',
                'action' => route('admin.posts.store')
                ])
            </div>
        </div>
    </div>
</div>
@endsection
