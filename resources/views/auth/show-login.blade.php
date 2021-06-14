@extends('layouts.app')

@section('title', __('ログイン'))

@section('content')
<form method="POST" action="{{ route('login') }}" class="needs-validation @if($errors->any())was-validated @endif"
    novalidate>
    @csrf
    <img class="mb-4" src="https://getbootstrap.jp/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72"
        height="57">
    <h1 class="h3 mb-3 fw-normal">ログインする</h1>
    <label for="login_id" class="visually-hidden">ログインID</label>
    <input type="text" id="login_id" class="form-control" name="login_id" placeholder="ログインID" required autofocus>
    <label for="password" class="visually-hidden">パスワード</label>
    <input type="password" id="password" class="form-control" name="password" placeholder="パスワード" required>
    {{-- <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div> --}}
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger invalid-feedback" role="alert">{{ $error }}</div>
    @endforeach
    @endif
    <button class="w-100 btn btn-lg btn-primary" type="submit">ログイン</button>
</form>
<a class="w-100 btn btn-lg btn-success mt-5" href="{{ route('users.add') }}" role="button">新規登録</a>
<p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
@endsection