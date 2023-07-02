@extends('common.layout')

@section('style')

@endsection

@section('title')

@endsection

@section('header')

@endsection

@section('content')
    <style>
        body{
            min-height: 100vh;
        }
    </style>
    <img src="/img/404.jpg" style="height: 450px; float: left; margin-left: 120px; margin-top: 115px">
    <div style="text-align: center; color: black; margin-top: 160px">
        <h1 style="font-size: 80px">404</h1>
        <h3 style="font-size: 40px; margin-bottom: 30px">Page Not Found</h3>
        <p style="font-size: 30px; margin-bottom: 20px">Sorry, we could not find<br>the page you requested.</p>
        <a class="button" href="{{ url()->previous() }}" style="margin-bottom: 160px">GO BACK</a>
    </div>
@endsection
