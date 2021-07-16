@extends('layouts.app')

@section('title', 'シナリオ管理')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">シナリオ管理</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">シナリオ管理</div>
            <div class="card-body">
                <form action="{{ route('scenarios.manage') }}" method="get" novalidate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">タイトル</label>
                            <input type="text" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                value="{{ old('title', $input['title']) }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="genre" class="form-label">ジャンル</label>
                            <select id="genre" class="form-select{{ $errors->has('genre') ? ' is-invalid' : '' }}"
                                name="genre">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::GENRE_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('genre', $input['genre'])==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="platform" class="form-label">プラットフォーム</label>
                            <select id="platform" class="form-select{{ $errors->has('platform') ? ' is-invalid' : '' }}"
                                name="platform">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::PLATFORM_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('platform', $input['platform'])==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('platform') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="public_flg" class="form-label">公開フラグ</label>
                            <select id="public_flg" class="form-select{{ $errors->has('public_flg') ? ' is-invalid' : '' }}"
                                name="public_flg">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::PUBLIC_FLG_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('public_flg', $input['public_flg'])==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('public_flg') }}</div>
                        </div>

                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-primary w-50" type="submit">シナリオ検索</button>
                            <a class="btn btn-secondary" href="{{ route('top') }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header text-end">
                {{ $scenarios->links('vendor.pagination.bootstrap-4_number') }}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">タイトル</th>
                            <th>仮タイトル</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scenarios as $scenario)
                        <tr>
                            <th scope="rol">
                                <a href="{{ route('scenarios.manage_detail', ['id' => $scenario->id]) }}">{{ $scenario->title }}</a>
                            </th>
                            <td>{{ $scenario->user->user_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $scenarios->appends($input)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection