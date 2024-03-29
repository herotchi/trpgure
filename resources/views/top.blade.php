@extends('layouts.app')

@php
    $indexFlg = true;
@endphp

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
            <div class="card-header">最近のセッション</div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($scenarios as $scenario)
                    <a href="{{ route('scenarios.detail', ['id' => $scenario->id]) }}" class="list-group-item list-group-item-action">
                        <p class="mb-1 ml-4">
                            <span>募集者：{{ $scenario->user->user_name }}</span>
                        </p>
                        <div class="d-flex">
                            <h5 class="mb-1">{{ $scenario->title }}</h5>
                            
                        </div>
                        <p class="mb-1 ml-4 text-truncate">
                            <span class="font-weight-bold">概要</span>：{{ $scenario->summary }}
                        </p>
                        <p class="mb-1 ml-4"><span class="font-weight-bold">推奨人数</span>：
                            @if ($scenario->rec_number_min === $scenario->rec_number_max)
                            {{ $scenario->rec_number_min }}人
                            @else
                            {{ $scenario->rec_number_min }}～{{ $scenario->rec_number_max }}人
                            @endif
                        </p>
                        <p class="mb-1 ml-4">
                            <span class="font-weight-bold">募集期間</span>：
                            {{ $scenario->part_period_start->format('Y/m/d') }}～{{ $scenario->part_period_end->format('Y/m/d') }}
                        </p>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('scenarios.list') }}">すべてのセッション</a>
            </div>
        </div>
    </div>
</div>

@endsection
