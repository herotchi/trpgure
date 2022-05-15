@extends('layouts.no_navbar_app')

@php
    $indexFlg = true;
@endphp

@section('title', __('プライバシーポリシー'))

@section('content')

@include('layouts.privacy_policy_block')

@endsection
