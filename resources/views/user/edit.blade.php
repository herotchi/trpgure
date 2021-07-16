@extends('layouts.app')

@section('title', 'ユーザー名変更')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">ユーザー名変更</li>
    </ol>
</nav>

<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">ユーザー名変更</div>
            <div class="card-body">
                <form action="{{ route('users.update') }}" method="post" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="user_name" class="form-label">ユーザー名
                                <span class="text-danger font-weight-bold">※</span>
                            </label>
                            <input type="text" id="user_name"
                                class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}"
                                name="user_name" value="{{ old('user_name', Auth::user()->user_name) }}" required
                                autofocus>
                            <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-50" type="submit">更新する</button>
                            <a class="btn btn-secondary" href="{{ route('top') }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection