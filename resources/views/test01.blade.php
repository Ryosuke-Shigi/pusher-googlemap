@extends('layouts.root')

<!--タイトル-->
@section('title')
タイトル
@endsection

<!--meta情報-->
@section('meta')
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/maps.js') }} " defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyBMKajpItMT-Hy-YgCTAvSO13Eefz2OVnY&callback=initMap" defer></script>
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test01.css') }}" rel="stylesheet">
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test01.css') }}" rel="stylesheet">

@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="mapSector" id="map"></div>
            <div id="mapButtonSector" class="mapButtonSector">
                <div id="mapButtonA" class="buttonA">共有</div>
            </div>
        </div>
        <div class="container_B">
            <div class="commentSector" id="commentSector">
                <!--ここにコメントがはいります-->
            </div>
            <div class="messageSector" id="messageSector">
                <input type="text" class="text" id="comment"></input> <div id="sendButtonA" class="sendButtonA">send</div>
            </div>
        </div>
    </dvi>
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <input type="hidden" id="zoom">
@endsection
