@extends('layouts.app')

@section('title', 'シナリオ編集')

@push('datepicker')
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.ja.min.js') }}" defer></script>
    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                language: "ja",
                format: 'yyyy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endpush

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('scenarios.manage') }}">シナリオ管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">シナリオ編集</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">シナリオ編集</div>
            <div class="card-body">
                <form action="{{ route('scenarios.update') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $detail->id }}">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">タイトル
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <input type="text" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                value="{{ old('title', $detail->title) }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="col-md-12">
                            <label for="summary" class="form-label">概要</label>
                            <textarea id="summary"
                                class="form-control{{ $errors->has('summary') ? ' is-invalid' : '' }}" name="summary"
                                rows="3">{{ old('summary', $detail->summary) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('summary') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="genre" class="form-label">ジャンル
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <select id="genre" class="form-select{{ $errors->has('genre') ? ' is-invalid' : '' }}"
                                name="genre">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::GENRE_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('genre', $detail->genre)==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="platform" class="form-label">プラットフォーム
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <select id="platform" class="form-select{{ $errors->has('platform') ? ' is-invalid' : '' }}"
                                name="platform">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::PLATFORM_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('platform', $detail->platform)==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('platform') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="rec_number_min" class="form-label">推奨人数（最小）
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <select id="rec_number_min"
                                class="form-select{{ $errors->has('rec_number_min') ? ' is-invalid' : '' }}"
                                name="rec_number_min">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::REC_NUMBER_LIST as $value)
                                <option value="{{ $value }}" @if(old('rec_number_min', $detail->rec_number_min)==$value) selected="selected"
                                    @endif>{{ $value }}人</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('rec_number_min') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="rec_number_max" class="form-label">推奨人数（最大）
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <select id="rec_number_max"
                                class="form-select{{ $errors->has('rec_number_max') ? ' is-invalid' : '' }}"
                                name="rec_number_max">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::REC_NUMBER_LIST as $value)
                                <option value="{{ $value }}" @if(old('rec_number_max', $detail->rec_number_max)==$value) selected="selected"
                                    @endif>{{ $value }}人</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('rec_number_max') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="part_period_start" class="form-label">参加募集開始日</label>
                            <input type="text" id="part_period_start"
                                class="datepicker form-control{{ $errors->has('part_period_start') ? ' is-invalid' : '' }}"
                                name="part_period_start" value="{{ old('part_period_start', $detail->part_period_start ? $detail->part_period_start->format('Y/m/d') : '') }}">
                            <div class="invalid-feedback">{{ $errors->first('part_period_start') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="part_period_end" class="form-label">参加募集終了日</label>
                            <input type="text" id="part_period_end"
                                class="datepicker form-control{{ $errors->has('part_period_end') ? ' is-invalid' : '' }}"
                                name="part_period_end" value="{{ old('part_period_end', $detail->part_period_end ? $detail->part_period_end->format('Y/m/d') : '') }}">
                            <div class="invalid-feedback">{{ $errors->first('part_period_end') }}</div>
                        </div>

                        <div class="col-md-12">
                            <label for="rec_skill" class="form-label">推奨技能</label>
                            <textarea id="rec_skill"
                                class="form-control{{ $errors->has('rec_skill') ? ' is-invalid' : '' }}"
                                name="rec_skill" rows="3">{{ old('rec_skill', $detail->rec_skill) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('rec_skill') }}</div>
                        </div>

                        <div class="col-md-12">
                            <label for="caution" class="form-label">注意事項</label>
                            <textarea id="caution"
                                class="form-control{{ $errors->has('caution') ? ' is-invalid' : '' }}" name="caution"
                                rows="3">{{ old('caution', $detail->caution) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('caution') }}</div>
                        </div>

                        <div class="col-md-12">
                            <label for="gm_memo" class="form-label">GM用メモ</label>
                            <textarea id="gm_memo"
                                class="form-control{{ $errors->has('gm_memo') ? ' is-invalid' : '' }}" name="gm_memo"
                                rows="4">{{ old('gm_memo', $detail->gm_memo) }}</textarea>
                            <div class="invalid-feedback">{{ $errors->first('gm_memo') }}</div>
                        </div>

                        <label class="form-label">公開フラグ
                            <span class="text-danger font-weight-bold">※</span>
                        </label>
                        <div class="btn-group mt-0">
                            @foreach(ScenarioConsts::PUBLIC_FLG_LIST as $key => $value)
                            <input type="radio" class="btn-check" name="public_flg" id="public_flg_{{ $key }}"
                                value="{{ $key }}" autocomplete="off" @if(old('public_flg', $detail->public_flg)==$key) checked @endif>
                            <label
                                class="btn btn-outline-success form-control{{ $errors->has('public_flg') ? ' is-invalid' : '' }}"
                                for="public_flg_{{ $key }}">{{ $value }}</label>
                            @endforeach
                        </div>
                        <div class="mt-0{{ $errors->has('public_flg') ? ' is-invalid' : '' }}"></div>
                        <div class="invalid-feedback">{{ $errors->first('public_flg') }}</div>

                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-primary w-50" type="submit">保存する</button>
                            <a class="btn btn-secondary" href="{{ route('scenarios.manage_detail', ['id' => $detail->id]) }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection