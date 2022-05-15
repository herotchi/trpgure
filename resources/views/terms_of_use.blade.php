@extends('layouts.no_navbar_app')

@php
    $indexFlg = true;
@endphp

@section('title', __('利用規約'))

@section('content')

@include('layouts.terms_of_use_block')

@endsection
