@extends('layouts.app')

@section('title', 'アカウント作成')

@push('add_user')
<link href="{{ asset('css/add_user.css') }}" rel="stylesheet">
<script type="text/javascript">
    function userPolicy() {
        $('input[name="user_policy"]').prop("disabled", false);
    }
</script>
@endpush

@section('content')
<div class="form-add-user">
    <div class="py-3 text-center">
        <img class="mb-4" src="https://getbootstrap.jp/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72"
            height="57">
        <h1 class="h3 mb-3 fw-normal">アカウント作成</h1>
    </div>
    <form method="POST" action="{{ route('users.insert') }}" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <input type="text" id="user_name"
                    class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name"
                    value="{{ old('user_name') }}" placeholder="ユーザー名" required autofocus>
                <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
            </div>
            <div class="col-12">
                <input type="text" id="login_id" class="form-control{{ $errors->has('login_id') ? ' is-invalid' : '' }}"
                    name="login_id" value="{{ old('login_id') }}" placeholder="ログインID" required>
                <div class="invalid-feedback">{{ $errors->first('login_id') }}</div>
            </div>
            <div class="col-12">
                <input type="password" id="password"
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                    placeholder="パスワード" required>
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            </div>
            <div class="col-12">
                <input type="password" id="password_confirmation"
                    class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                    name="password_confirmation" placeholder="パスワード確認" required>
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" id="user_policy"
                        class="form-check-input text-center{{ $errors->has('user_policy') ? ' is-invalid' : '' }}"
                        name="user_policy" value="yes" {{ old('user_policy') ? 'checked' : 'disabled="disabled"' }} 
                        required>
                    <label class="form-check-label" for="user_policy">
                        <span class="text-info text-decoration-underline" data-bs-toggle="modal"
                            data-bs-target="#user_policy_modal">利用規約</span>に同意する
                    </label>
                    <div class="invalid-feedback">{{ $errors->first('user_policy') }}</div>
                </div>
            </div>
            <div class="col-7">
                <button class="btn btn-primary" type="submit">アカウント作成</button>
            </div>
            <div class="col-5 text-end">
                <a class="btn btn-secondary" href="{{ route('login') }}" role="button">戻る</a>
            </div>
        </div>
    </form>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="user_policy_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="user_policy_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content text-start">
            <div class="modal-header">
                <h2 class="modal-title" id="user_policy_modal">利用規約</h2>
            </div>
            <div class="modal-body">
                @include('layouts.terms_of_use_block')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="userPolicy()">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endsection