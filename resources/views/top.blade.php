@extends('layouts.app')

@section('title', 'TOP')

@section('content')

<nav aria-label="パンくずリスト">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ホーム</li>
    </ol>
</nav>

<div class="row justify-content-center g-3">
    <div class="col">
        <div class="card">
            <div class="card-header">最近のシナリオ</div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($lists as $list)
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $list->title }}</h5>
                            <small>作：{{ $list->users->user_name }}</small>
                        </div>
                        <p class="mb-1 ml-4 text-truncate">
                            <span class="font-weight-bold">概要</span>：{{ Str::limit($list->summary, 30, '...') }}
                        </p>
                        <p class="mb-1 ml-4">
                            <span class="font-weight-bold">募集期間</span>：
                            {{ $list->part_period_start ? $list->part_period_start->format('Y/m/d') : '' }}
                            @if ($list->part_period_start || $list->part_period_end) ～ @endif
                            @if ($list->part_period_end) 
                            <span class="font-weight-bold">{{ $list->part_period_end->format('Y/m/d') }}</span>
                            @endif
                        </p>
                        <p class="mb-1 ml-4"><span class="font-weight-bold">推奨人数</span>：
                            @if ($list->rec_number_min === $list->rec_number_max)
                            {{ $list->rec_number_min }}人
                            @else
                            {{ $list->rec_number_min }}人
                            ～
                            {{ $list->rec_number_max }}人
                            @endif
                        </p>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('scenarios.list') }}">すべてのシナリオ</a>
            </div>
        </div>
    </div>
</div>

@endsection
