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
    <link href="{{ asset('css/delRooms.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }} " defer></script>

@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="titleSection">
                <div class="nextButtonB">戻 る</div>
            </div>
            <div class="topSection">
                <div class="naviSector">
                    削除選択
                </div>
                <div class="roomsSector">
                    @foreach($table as $key=>$data)
                        <div class="chatRoom" data-room_name={{ $data->roomName }}>{{ $data->roomName }}</div>
                    @endforeach
                </div>
            </div>
            <form method="GET" id="nextActionA" action="{{ route('route.delRoom') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roomName" id="roomName">
            </form>
            <form method="GET" id="nextActionB" action="{{ route('route.viewRooms') }}"></form>
        </div>
    </dvi>
@endsection
