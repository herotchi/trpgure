@extends('layouts.app')

@section('title', 'キャラクター編集')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item"><a href="{{ route('characters.manage') }}">キャラクター管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">キャラクター編集</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">キャラクター編集</div>
            <div class="card-body">
                <form action="{{ route('characters.update') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $detail->id }}">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">キャラクター名
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <input type="text" id="name"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                value="{{ old('name', $detail->name) }}" required autofocus>
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
                                    <option value="{{ $key }}" @if(old('service', $detail->service)==$key)
                                        selected="selected" @endif>
                                        {{ CharacterConsts::SERVICE_LIST[$key] }}（{{ $value }}）</option>
                                    @endforeach
                                </select>
                                <input type="text" id="character_sheet"
                                    class="form-control{{ $errors->has('character_sheet') ? ' is-invalid' : '' }}"
                                    name="character_sheet" value="{{ old('character_sheet', $detail->character_sheet) }}" aria-describedby="characterSheetBlock">
                                <div class="invalid-feedback">{{ $errors->first('service') }}</div>
                                <div class="invalid-feedback">{{ $errors->first('character_sheet') }}</div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-primary w-50" type="submit">更新する</button>
                            <a class="btn btn-secondary" href="{{ route('characters.manage') }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.question_modal')
@endsection
