@extends('layouts.root')

<!--タイトル-->
@section('title')
ルーム作成
@endsection

<!--meta情報-->
@section('meta')
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/roomCreate.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }} " defer></script>

@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
{{--             <div class="titleSection">
            </div> --}}
            <div class="topSection">
                <div class="naviSector">
                    ルーム作成
                </div>
                <div class="mainSector">
                    <form method="GET" id="nextActionA" action="{{ route('create.room') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="infoContentA">
                            <div class="nameSpace">ルーム名</div>
                            <div class="inputSpace">
                                <input type="text" class="text" name="roomName">
                            </div>
                        </div>
                        <div class="infoContentA">
                            <div class="nameSpace">パスワード</div>
                            <div class="inputSpace">
                                <input type="text" class="text" name="pass">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="buttonSector">
                    <div class="nextButtonA">登 録</div>
                    <div class="backButtonA">戻 る</div>
                </div>
            </div>
        </div>
    </dvi>
    <form method="GET" id="backActionA" action="{{ route('route.viewRooms') }}" enctype="multipart/form-data"></form>
@endsection
