@extends('layouts.app')

@section('title', 'フレンド管理')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">フレンド管理</li>
    </ol>
</nav>

<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">フレンド管理</div>
            <div class="card-body">
                <!-- タブ部分 -->
                <ul id="myTab" class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button id="following-tab" class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#following" type="button" role="tab" aria-controls="following"
                            aria-selected="true">フォロー</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button id="followed-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#followed"
                            type="button" role="tab" aria-controls="followed" aria-selected="false">プロフィール</button>
                    </li>
                </ul>
                <!-- パネル部分 -->
                <div id="myTabContent" class="tab-content">
                    <div id="following" class="tab-pane active" role="tabpanel" aria-labelledby="following-tab">
                        <ul class="list-group">
                            @foreach($user->followings as $following)
                            <li class="list-group-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-9 col-7">
                                        {{ $following->user_name }}
                                    </div>
                                    <div class="col-sm-3 col-5 text-end">
                                        <a class="btn btn-secondary btn-sm"
                                            href="{{ route('top') }}{{-- {{ route('characters.detail', ['id' => $list->id]) }} --}}"
                                            role="button">解除</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="followed" class="tab-pane" role="tabpanel" aria-labelledby="followed-tab">
                        <ul class="list-group">
                            @foreach($user->followeds as $followed)
                            <li class="list-group-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-9 col-7">
                                        {{ $followed->user_name }}
                                    </div>
                                    <div class="col-sm-3 col-5 text-end">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('top') }}{{-- {{ route('characters.detail', ['id' => $list->id]) }} --}}"
                                            role="button">フォロー</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection