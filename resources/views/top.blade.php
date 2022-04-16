@extends('layouts.root')

<!--タイトル-->
@section('title')
MAPチャット
@endsection

<!--meta情報-->
@section('meta')
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="nextButtonA" id="nextButtonA">MAP<br>CHAT</div>
            <form method="GET" id="nextActionA" action="{{ route('route.viewRooms') }}"></form>
        </div>
    </dvi>
@endsection
