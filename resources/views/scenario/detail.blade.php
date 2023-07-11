@extends('layouts.app')

@section('title', 'セッション詳細')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('scenarios.list') }}">セッション一覧</a></li>
        <li class="breadcrumb-item active" aria-current="page">セッション詳細</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">セッション詳細</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5>セッション募集者</h5>
                    <span>{{ $detail->user->user_name }}</span>
                </li>
                <li class="list-group-item">
                    <h5>タイトル</h5>
                    <span>{{ $detail->title }}</span>
                </li>
                <li class="list-group-item">
                    <h5>概要</h5>
                    <span>{!! nl2br(e($detail->summary)) !!}</span>
                </li>
                <li class="list-group-item">
                    <h5>システム</h5>
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
                        {{ $detail->part_period_start->format('Y/m/d') }}～{{ $detail->part_period_end->format('Y/m/d') }}
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
                    <h5>セッション参加者</h5>
                    <span>
                        @foreach ($detail->characters as $character)
                        @if ($character->user_friend_code == Auth::user()->friend_code)
                        {{ $character->name }}
                        @else
                            @if(empty($character->service) || empty($character->character_sheet))
                            {{ $character->name }}
                            @else
                            <a href="https://{{ CharacterConsts::SERVICE_DOMAIN_LIST[$character->service] }}{{ $character->character_sheet }}" 
                                target="_blank" rel="noopener noreferrer">{{ $character->name }}@include('layouts.blank')</a>
                            @endif
                        @endif
                        （{{ $character->user->user_name }}）
                        @if (!$loop->last),&ensp;@endif
                        @endforeach
                    </span>
                </li>
            </ul>
            <div class="col-12 text-center my-4">
                @if ($followingFlg && $followedFlg && $joiningFlg)
                <button class="btn btn-outline-danger w-50" type="button" data-bs-toggle="modal"
                    data-bs-target="#cancelModal">参加を取り消す</button>
                @elseif ($followingFlg && $followedFlg && !$joiningFlg)
                <a href="{{ route('scenarios.join', ['id' => $detail->id]) }}" class="btn btn-primary w-50" role="button">参加する</a>
                @endif
                <a class="btn btn-secondary" href="{{ route('scenarios.list') }}" role="button">戻る</a>
            </div>
        </div>
    </div>
</div>
{{-- 
<!-- 参加モーダルの設定 -->
<div class="modal fade" id="joinModal" tabindex="-1" aria-labelledby="joinModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('scenarios.join') }}" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $detail->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinModalLabel">セッション参加</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <strong>{{ $detail->title }}</strong>
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">キャラクター名
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <input type="text" id="name"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                value="{{ old('name') }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="col-md-12">
                            <label for="character_sheet" class="form-label">キャラクターシート
                                @include('layouts.question')
                            </label>
                            <div class="input-group">
                                <select id="service"
                                    class="form-select{{ $errors->has('service') ? ' is-invalid' : '' }}"
                                    name="service" aria-describedby="characterSheetBlock">
                                    <option value="">--</option>
                                    @foreach(CharacterConsts::SERVICE_DOMAIN_LIST as $key => $value)
                                    <option value="{{ $key }}" @if(old('service')==$key)
                                        selected="selected" @endif>
                                        {{ $value }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="character_sheet"
                                    class="form-control{{ $errors->has('character_sheet') ? ' is-invalid' : '' }}"
                                    name="character_sheet" value="{{ old('character_sheet') }}" aria-describedby="characterSheetBlock">
                                <div class="invalid-feedback">{{ $errors->first('service') }}</div>
                                <div class="invalid-feedback">{{ $errors->first('character_sheet') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary w-50">決定</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 --}}
<!-- 参加取り消しモーダルの設定 -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('scenarios.cancel') }}" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $detail->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">セッション参加取り消し</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p><u class="text-danger">※参加を取り消すと作成したキャラクターが削除されます。</u></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger w-50">決定</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection