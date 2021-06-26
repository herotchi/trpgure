@extends('layouts.app')

@section('title', 'フレンド登録')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">フレンド登録</li>
    </ol>
</nav>
@php
    //var_dump($errors);
@endphp
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">フレンド登録</div>
            <div class="card-body">
                <form action="{{ route('friends.insert') }}" method="post" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="friend_code" class="form-label">フレンドコード
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <input type="text" id="friend_code"
                                class="form-control{{ $errors->has('friend_code') ? ' is-invalid' : '' }}"
                                name="friend_code" value="{{ old('friend_code') }}" required
                                autofocus>
                            <div class="invalid-feedback">{{ $errors->first('friend_code') }}</div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-50" type="submit">フレンド登録</button>
                            <a class="btn btn-secondary" href="{{ route('top') }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection