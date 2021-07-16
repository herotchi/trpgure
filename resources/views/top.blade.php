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
                    @foreach($scenarios as $scenario)
                    <a href="{{ route('scenarios.detail', ['id' => $scenario->id]) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $scenario->title }}</h5>
                            <span>作：{{ $scenario->user->user_name }}</span>
                        </div>
                        <p class="mb-1 ml-4 text-truncate">
                            <span class="font-weight-bold">概要</span>：{{ $scenario->summary }}
                        </p>
                        <p class="mb-1 ml-4">
                            <span class="font-weight-bold">募集期間</span>：
                            {{ $scenario->part_period_start ? $scenario->part_period_start->format('Y/m/d') : '' }}
                            @if ($scenario->part_period_start || $scenario->part_period_end)～@endif
                            @if ($scenario->part_period_end) 
                            <span class="font-weight-bold">{{ $scenario->part_period_end->format('Y/m/d') }}</span>
                            @endif
                        </p>
                        <p class="mb-1 ml-4"><span class="font-weight-bold">推奨人数</span>：
                            @if ($scenario->rec_number_min === $scenario->rec_number_max)
                            {{ $scenario->rec_number_min }}人
                            @else
                            {{ $scenario->rec_number_min }}人
                            ～
                            {{ $scenario->rec_number_max }}人
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
