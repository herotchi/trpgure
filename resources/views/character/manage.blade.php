@extends('layouts.app')

@section('title', 'キャラクター管理')

@push('delete')
<script type="text/javascript" defer>
    $(document).ready(function() {
        $(document).on("click", "button#deleteCharacter", function(){
            $('input[name="id"]').val($(this).data('id'));
        });
    });
</script>
@endpush

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
                            <th>参加セッション名</th>
                            <th>セッション募集者</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($characters as $character)
                        <tr>
                            <td scope="rol" class="align-middle">
                                <a href="https://{{ CharacterConsts::SERVICE_DOMAIN_LIST[$character->service] }}{{ $character->character_sheet }}" target="_blank"
                                    rel="noopener noreferrer">{{ $character->name }}@include('layouts.blank')</a>
                            </td>
                            <td class="align-middle">
                                {{ $character->scenario->title }}
                            </td>
                            <td class="align-middle">
                                {{ $character->scenario->user->user_name }}
                            </td>
                            <td class="align-middle float-end">
                                <a class="btn btn-sm btn-primary" href="{{ route('characters.edit', ['id' => $character->id]) }}">編集</a>
                                <button type="button" id="deleteCharacter" class="btn btn-sm btn-outline-danger ms-3" data-id="{{ $character->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">削除</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $characters->appends($input)->links() }}
            </div>
        </div>
    </div>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('characters.delete') }}" novalidate>
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">作成したキャラクターを削除しますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-danger w-50" type="submit">削除する</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection