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

                    @adminFormGroup('name')
                    <label for="name">カテゴリー名</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                    @endFormGroup

                    @adminFormGroup('slug')
                    <label for="slug">URL名（スラッグ）</label>
                    <input type="text" name="slug" class="form-control" required>
                    @error('slug')
                    @endFormGroup

                    <button type="submit" class="w-full button button-primary">登録する</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
