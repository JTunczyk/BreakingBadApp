<?php if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /");
    die();
}; ?>

@extends('layouts.layout')

@section('css')
<style>
    .gradebox {
        font-size: 20px;
        line-height: 30px;
        border: 3px solid white;
        margin: 40px;
        display: inline-block;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        background-color: gray;
        min-width: 250px;
        min-height: 400px;
    }

    #container {
        top: 0% !important;
        left: 0% !important;
        min-width: 100%;
        transform: none !important;
    }

    .first,
    .second {
        background-color: white;
        color: black;
        border-bottom: solid red 3px;
    }
</style>
@endsection

<!-- wyswietlenie kazdego nauczyciela z zwroconej tabeli -->
@section('content')
    @foreach($end as $each)
        <div class="gradebox" style="background-image: url('{{$each->third}}'), url('/images/noimg.png');" />
        <span class="first">{{$each->first}}</span><br />
        <span class="second">{{$each->second}}</span>
        </div>
    @endforeach
@endsection