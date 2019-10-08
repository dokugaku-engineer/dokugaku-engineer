@extends('layouts.admin')

@section('title', "カテゴリー一覧")

@section('content')
<div class="row page-heading">
    <div class="col-lg-10">
        <h1 class="">カテゴリーの新規作成</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-title">
                <h4>新規作成</h5>
            </div>
            <div class="box-content">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
