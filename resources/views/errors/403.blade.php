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
    <img src="/img/403.jpg" style="height: 600px; float: left; margin-left: 200px; margin-top: 20px">
    <div style="text-align: center; color: black; margin-top: 160px">
        <h1 style="font-size: 80px">403</h1>
        <h3 style="font-size: 40px; margin-bottom: 30px">Forbidden</h3>
        <p style="font-size: 30px; margin-bottom: 20px">Sorry, you don't have permission<br>to access this page.</p>
        <a class="button" href="{{ url()->previous() }}" style="margin-bottom: 160px">GO BACK</a>
    </div>
@endsection
