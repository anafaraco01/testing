@extends('common.layout')

@section('content')
    <style>
        body{
            display: grid;
            grid-template-rows: 15vh 20vh 50vh 15vh;
        }
        footer{
            margin-top:auto;
        }
    </style>
    <section class="hero  is-bold" style="background-color: #092F20; opacity: 80%;">
        <div class="hero-body">
            <div class="container">
                <p class="title is-2" style="color: white; margin-top: 28px">Tour ID: {{ $route->id }}</p>
            </div>
        </div>
    </section>
    <section class="section" style="padding-top: 25px">
        <div class="container" style="text-align: center; margin-top: 100px">
            <p class="title">Starting Point: {{ $route->start_place }}</p>
            <p class="title">Ending Point: {{ $route->end_place }}</p>
            <p class="title">Truck ID: {{ $route->truck_id }}</p>
            <div class="control">
                <a type="button" href="/routes" class="button is-light">Back</a>
            </div>
            <div class="columns">
                <div class="column is-12">
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
