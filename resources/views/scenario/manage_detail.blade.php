@extends('layouts.app')

@section('title', 'シナリオ詳細')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('scenarios.manage') }}">シナリオ管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">シナリオ詳細</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">シナリオ詳細</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5>タイトル</h5>
                    <span>{{ $detail->title }}</span>
                </li>
                <li class="list-group-item">
                    <h5>概要</h5>
                    <span>{!! nl2br(e($detail->summary)) !!}</span>
                </li>
                <li class="list-group-item">
                    <h5>ジャンル</h5>
                    <span>{{ ScenarioConsts::GENRE_LIST[$detail->genre] }}</span>
                </li>
                <li class="list-group-item">
                    <h5>プラットフォーム</h5>
                    <span>{{ ScenarioConsts::PLATFORM_LIST[$detail->platform] }}</span>
                </li>
                <li class="list-group-item">
                    <h5>推奨参加人数</h5>
                    <span>
                        @if ($detail->rec_number_min === $detail->rec_number_max)
                        {{ $detail->rec_number_min }}人
                        @else
                        {{ $detail->rec_number_min }}人～{{ $detail->rec_number_max }}人
                        @endif
                    </span>
                </li>
                <li class="list-group-item">
                    <h5>参加募集期間</h5>
                    <span>
                        @if ($detail->part_period_start)
                        {{ $detail->part_period_start->format('Y/m/d') }}
                        @endif
                        @if ($detail->part_period_start || $detail->part_period_end)
                        ～
                        @endif
                        @if ($detail->part_period_end)
                        {{ $detail->part_period_end->format('Y/m/d') }}
                        @endif
                    </span>
                </li>
                <li class="list-group-item">
                    <h5>推奨技能</h5>
                    <span>{!! nl2br(e($detail->rec_skill)) !!}</span>
                </li>
                <li class="list-group-item">
                    <h5>注意事項</h5>
                    <span>{!! nl2br(e($detail->caution)) !!}</span>
                </li>
                <li class="list-group-item">
                    <h5>GM用メモ</h5>
                    <span>{!! nl2br(e($detail->gm_memo)) !!}</span>
                </li>
                <li class="list-group-item">
                    <h5>公開フラグ</h5>
                    <span>{{ ScenarioConsts::PUBLIC_FLG_LIST[$detail->public_flg] }}</span>
                </li>
            </ul>
            <div class="col-12 text-center my-4">
                <a class="btn btn-primary w-50" href="{{ route('scenarios.edit', ['id' => $detail->id]) }}"
                    role="button">編集する</a>
                <a class="btn btn-secondary" href="{{ route('scenarios.manage') }}" role="button">戻る</a>
                @if (!$joinedFlg)
                <button type="button" class="btn btn-outline-danger ms-sm-5" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">削除する</button>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('scenarios.delete') }}" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $detail->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">主催したシナリオを削除しますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
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