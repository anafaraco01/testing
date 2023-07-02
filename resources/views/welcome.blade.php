@extends('common.layout')

@section('style')

@endsection

@section('content')
    <style>
        body{
            background-image: url('/img/home-bg.webp');
            background-size: cover;background-repeat: no-repeat;
        }
    </style>
    <h1 style="font-size: 110px; background-color: lightgray; opacity: 70%" class="has-text-centered">Flor'as Fleurs</h1>
    <section style="background-color: #e2e8f0; width: 700px; margin-left: 50vh">
        <p style="margin-top: 90px" class="is-size-4 has-text-centered">Dankzij ruim 30 jaar ervaring garanderen wij de hoogste <br>
            kwaliteit bloemen en planten voor de Franse markt, <br>
            direct vanuit de Nederlanse bloemenveiling in Naaldwijk.
        </p>
    </section>
    <p style="color: white; font-size: 60px; font-family: Lucida Handwriting; margin-top: 90px" class="has-text-centered">Adding color to your life,<br>one flower at a time</p>

@endsection
