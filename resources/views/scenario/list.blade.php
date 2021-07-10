@extends('layouts.app')

@section('title', 'シナリオ一覧')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">シナリオ一覧</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">シナリオ一覧</div>
            <div class="card-body">
                <form action="{{ route('scenarios.list') }}" method="get" novalidate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">タイトル</label>
                            <input type="text" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                value="{{ old('title', $inputs['title']) }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="friend_code" class="form-label">シナリオ制作者</label>
                            <select id="friend_code"
                                class="form-select{{ $errors->has('friend_code') ? ' is-invalid' : '' }}"
                                name="friend_code">
                                <option value="">---</option>
                                @foreach($friendLists->followings as $following)
                                <option value="{{ $following->friend_code }}" @if(old('friend_code', $inputs['friend_code'])==$following->friend_code) selected="selected"
                                    @endif>{{ $following->user_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('friend_code') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="genre" class="form-label">ジャンル</label>
                            <select id="genre" class="form-select{{ $errors->has('genre') ? ' is-invalid' : '' }}"
                                name="genre">
                                <option value="">---</option>
                                @foreach(ScenarioConsts::GENRE_LIST as $key => $value)
                                <option value="{{ $key }}" @if(old('genre', $inputs['genre'])==$key) selected="selected" @endif>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
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
                {{ $lists->links('vendor.pagination.bootstrap-4_number') }}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">タイトル</th>
                            <th>シナリオ制作者</th>
                            <th>ステータス</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $list)
                        <tr>
                            <th scope="rol">
                                <a href="{{ route('scenarios.detail', ['id' => $list->id]) }}">{{ $list->title }}</a>
                            </th>
                            <td>{{ $list->users->user_name }}</td>
                            <td>{{ $list->title }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $lists->appends($inputs)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection