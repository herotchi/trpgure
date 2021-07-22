@extends('layouts.app')

@section('title', 'セッション一覧')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">セッション一覧</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">セッション一覧</div>
            <div class="card-body">
                <form action="{{ route('scenarios.list') }}" method="get" novalidate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="title" class="form-label">タイトル</label>
                            <input type="text" id="title"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                value="{{ old('title', $input['title']) }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="friend_code" class="form-label">セッション募集者</label>
                            <select id="friend_code"
                                class="form-select{{ $errors->has('friend_code') ? ' is-invalid' : '' }}"
                                name="friend_code">
                                <option value="">---</option>
                                @foreach($followingList as $following)
                                <option value="{{ $following->friend_code }}" @if(old('friend_code', $input['friend_code'])==$following->friend_code) selected="selected"
                                    @endif>{{ $following->user_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('friend_code') }}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="genre" class="form-label">システム</label>
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

                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-primary w-50" type="submit">セッション検索</button>
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
                            <th>セッション募集者</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scenarios as $scenario)
                        <tr>
                            <th scope="rol">
                                <a href="{{ route('scenarios.detail', ['id' => $scenario->id]) }}">{{ $scenario->title }}</a>
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