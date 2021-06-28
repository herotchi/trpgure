@extends('layouts.app')

@section('title', 'フレンド管理')

@push('remove')
<script type="text/javascript">
    function modal(userName, friendCode) {
            $('span#user_name').text(userName);
            $("input[name='friend_code']").val(friendCode);
        }
</script>
@endpush

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('top') }}">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">フレンド管理</li>
    </ol>
</nav>

<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">フレンド管理</div>
            <div class="card-body">

                {{-- <form method="POST" action="{{ route('friends.remove') }}" id="remove_form" novalidate>
                @csrf
                <input type="hidden" name="friend_code" value="">
                </form> --}}

                <!-- タブ部分 -->
                <ul id="myTab" class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button id="following-tab" class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#following" type="button" role="tab" aria-controls="following"
                            aria-selected="true">フォロー</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button id="followed-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#followed"
                            type="button" role="tab" aria-controls="followed" aria-selected="false">フォロワー</button>
                    </li>
                </ul>
                <!-- パネル部分 -->
                <div id="myTabContent" class="tab-content">
                    <div id="following" class="tab-pane active" role="tabpanel" aria-labelledby="following-tab">
                        <ul class="list-group">
                            @foreach($user->followings as $following)
                            <li class="list-group-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-9 col-7">
                                        {{ $following->user_name }}
                                    </div>
                                    <div class="col-sm-3 col-5 text-end">
                                        {{-- <a class="btn btn-secondary btn-sm"
                                            href="{{ route('friends.remove', ['friendCode' => $following->friend_code]) }}"
                                        role="button">解除</a> --}}
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#removeModal"
                                            onclick="modal('{{ $following->user_name }}', '{{ $following->friend_code }}')">
                                            解除
                                        </button>
                                        {{-- <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#removeModal" onclick="test('a', 'b')">
                                            解除
                                        </button> --}}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="followed" class="tab-pane" role="tabpanel" aria-labelledby="followed-tab">
                        <ul class="list-group">
                            @foreach($user->followeds as $followed)
                            <li class="list-group-item">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-9 col-7">
                                        {{ $followed->user_name }}
                                    </div>
                                    <div class="col-sm-3 col-5 text-end">
                                        @if(in_array($followed->friend_code, $friendCodes, true))
                                        <button type="button" class="btn btn-primary btn-sm" disabled>既フォロー</button>
                                        @else
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('friends.follow', ['friendCode' => $followed->friend_code]) }}"
                                            role="button">フォロー</a>
                                        @endif

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- モーダルの設定 -->
<div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('friends.remove') }}" novalidate>
                @csrf
                <input type="hidden" name="friend_code" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeModalLabel"><span id="user_name"></span>さんをフォロー解除しますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p>フォローを解除するとフォローしていたユーザーが作成したシナリオを閲覧したり参加することができなくなります。</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-50">フォロー解除</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection