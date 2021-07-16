@extends('layouts.app')

@section('title', 'キャラクター管理')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">キャラクター管理</li>
    </ol>
</nav>
<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">キャラクター管理</div>
            <div class="card-body">
                <form action="{{ route('characters.manage') }}" method="get" novalidate>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">キャラクター名</label>
                            <input type="text" id="name"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                value="{{ old('name', $input['name']) }}" required autofocus>
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        </div>

                        <div class="col-12 text-center mt-5">
                            <button class="btn btn-primary w-50" type="submit">キャラクター検索</button>
                            <a class="btn btn-secondary" href="{{ route('top') }}" role="button">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header text-end">
                {{ $characters->links('vendor.pagination.bootstrap-4_number') }}
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">キャラクター名</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($characters as $character)
                        <tr>
                            <th scope="rol">
                                <a href="{{ route('characters.manage_detail', ['id' => $character->id]) }}">{{ $character->name }}</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $characters->appends($input)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection