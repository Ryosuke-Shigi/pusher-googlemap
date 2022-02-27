@extends('layouts.root')

<!--タイトル-->
@section('title')
簡易MapChat
@endsection

<!--meta情報-->
@section('meta')
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rooms.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }} " defer></script>

@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="titleSection">
                <div class="nextButtonC">作 成</div>
                <div class="backButtonA">ＴＯＰ</div>
                <div class="nextButtonB">削 除</div>
            </div>
            <div class="topSection">
                <div class="naviSector">
                    ルームを選択してください
                </div>
                <div class="roomsSector">
                    @foreach($table as $key=>$data)
                        <div class="chatRoom" data-room_name={{ $data->roomName }}>{{ $data->roomName }}</div>
                    @endforeach
                </div>
            </div>
            <form method="GET" id="nextActionA" action="{{ route('route.login') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roomName" id="roomName">
            </form>
            <form method="GET" id="nextActionB" action="{{ route('route.viewDelRooms') }}"></form>
            <form method="GET" id="nextActionC" action="{{ route('route.roomCreate') }}"></form>
            <form method="GET" id="backActionA" action="{{ route("top") }}"></form>
        </div>
    </dvi>
@endsection
