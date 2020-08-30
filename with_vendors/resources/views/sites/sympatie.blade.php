<?php if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /");
    die();
}; ?>

@extends('layouts.layout')

@section('skrypt')
<script>
    function back() {
        document.cookie = "token= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        document.cookie = "mail= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
        window.open('<?php echo url('/') ?>', '_self');
    }

    function ret(a) {
        a = a || null; //domyslny parametr dla IE
        if (a == 2) {
            window.open('<?php echo url('wczytaj') ?>', '_self')
        } else if (a == 1) {
            window.open('<?php echo url('search') ?>', '_self');
        } else {
            window.open('<?php echo url('losuj') ?>', '_self');
        };
    }
</script>
@endsection


@section('content')
<div class="sympatiabox" style="margin-bottom: 5vw;" onclick="disappear(2)">Moje sympatie</div>
<div class="sympatiabox" style="margin-bottom: 5vw;" onclick="disappear(1)">Wyszukaj sympatie</div>
<div class="sympatiabox" onclick="disappear()">Losuj sympatie</div>
@endsection

@section('css')
<style>
    #back {
        background-image: url('/images/logout.png');
    }
</style>
@endsection