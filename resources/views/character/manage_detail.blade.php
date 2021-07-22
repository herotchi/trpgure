@extends('layouts.app')

@section('title', 'キャラクター詳細')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('characters.manage') }}">キャラクター管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">キャラクター詳細</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">キャラクター詳細</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5>参加セッション</h5>
                    <span>{{ $detail->scenario->title }}</span>
                </li>
                <li class="list-group-item">
                    <h5>キャラクター名</h5>
                    <span>{{ $detail->name }}</span>
                </li>
                <li class="list-group-item">
                    <h5>キャラクターシート</h5>
                    <span>{{ $detail->character_sheet }}</span>
                </li>
            </ul>
            <div class="col-12 text-center my-4">
                <a class="btn btn-primary w-50" href="{{ route('characters.edit', ['id' => $detail->id]) }}"
                    role="button">編集する</a>
                <a class="btn btn-secondary" href="{{ route('characters.manage') }}" role="button">戻る</a>
                <button type="button" class="btn btn-outline-danger ms-sm-5" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">削除する</button>
            </div>
        </div>
    </div>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('characters.delete') }}" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $detail->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">キャラクターを削除しますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p><u class="text-danger">※キャラクターを削除するとセッションの参加も取り消されます。</u></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-danger w-50" type="submit">削除する</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection