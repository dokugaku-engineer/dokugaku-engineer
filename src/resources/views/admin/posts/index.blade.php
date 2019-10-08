@extends('layouts.admin')

@section('title', "管理画面TOP")

@section('content')
<div>
    <header class="navbar bg-info text-white p-2">
        <span class="navbar-brand" href="#">管理画面TOP</span>
    </header>
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">ブログ管理</div>
                    <div class="card-body">
                        <ul>
                            <li><a href="">記事投稿</a></li>
                            <li><a href="">カテゴリー</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
