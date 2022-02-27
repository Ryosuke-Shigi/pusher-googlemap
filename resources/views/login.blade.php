@extends('layouts.root')

<!--タイトル-->
@section('title')
ルームイン
@endsection

<!--meta情報-->
@section('meta')
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }} " defer></script>

@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="titleSection">
            </div>
            <div class="topSection">
                <div class="naviSector">
                    {{ "ルーム：".$roomName }}@if(isset($error)) ：名前orパスワードエラー @endif
                </div>
                <div class="mainSector">
                    <form method="POST" id="nextActionA" action="{{ route('check.viewer') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="infoContentA">
                            <div class="nameSpace">名　前</div>
                            <div class="inputSpace">
                                <input type="text" class="text" name="name">
                            </div>
                        </div>
                        <div class="infoContentA">
                            <div class="nameSpace">パスワード</div>
                            <div class="inputSpace">
                                <input type="text" class="text" name="pass">
                            </div>
                        </div>
                        <input type="hidden" name="roomName" id="roomName" value={{ $roomName }}>
                        <input type="hidden" name="error">
                    </form>
                </div>
                <div class="buttonSector">
                    <div class="nextButtonA">入 る</div>
                    <div class="backButtonA">戻 る</div>
                </div>
            </div>
        </div>
    </dvi>
    <form method="GET" id="backActionA" action="{{ route('route.viewRooms') }}" enctype="multipart/form-data"></form>
@endsection
