@extends('layouts.root')

<!--タイトル-->
@section('title')
タイトル
@endsection

<!--meta情報-->
@section('meta')
    <script src="{{ asset('js/app.js') }}" defar></script>
    <script src="{{ asset('js/maps.js') }} " defar></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyBMKajpItMT-Hy-YgCTAvSO13Eefz2OVnY&callback=initMap" defer></script>
    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test01.css') }}" rel="stylesheet">    <link href="{{ asset('css/root.css') }}" rel="stylesheet">
    <link href="{{ asset('css/test01.css') }}" rel="stylesheet">
    <!-- ajax用 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<!--コンテンツ部分-->
@section('contents')
    <div class="wrapper">
        <div class="container_A">
            <div class="map" id="map"></div>
            <div id="mapButtonContainer" class="mapButtonContainer">
                <div id="mapButtonA" class="buttonA">共有</div>
            </div>
        </div>
    </dvi>
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <input type="hidden" id="zoom">
@endsection
