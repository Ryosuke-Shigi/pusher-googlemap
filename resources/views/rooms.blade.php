@extends('layouts.root')

<!--タイトル-->
@section('title')
タイトル
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
            </div>
            <div class="topSection">
                <div class="naviSector">
                    ルーム選択
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
        </div>
    </dvi>
@endsection
