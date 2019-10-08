@extends('layouts.admin')

@section('title', "カテゴリー一覧")

@section('content')
<div class="row page-heading">
    <div class="col-lg-10">
        <h1 class="">カテゴリー一覧</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-title">
                <div class="row">
                    <div class="col-sm-9">
                        <h4>カテゴリー</h5>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary btn-sm">新規作成</button>
                    </div>
                </div>
            </div>
            <div class="box-content">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>カテゴリー</th>
                            <th>編集</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>プログラミング学習方法</td>
                            <td><button type=" button" class="btn btn-outline-primary btn-xs">編集</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
