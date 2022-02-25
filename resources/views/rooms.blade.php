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
                </div>
                <div class="roomsSector">
                    <div class="chatRoom" data-room_name="test"></div>
              </div>
            </div>
            <form method="GET" id="nextActionA" action="{{ route('check.viewer') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roomName" id="roomName">
            </form>
        </div>
    </dvi>
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <input type="hidden" id="zoom">
@endsection
