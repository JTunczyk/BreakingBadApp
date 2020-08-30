<?php if (isset($_COOKIE["token"]) || isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /sympatie");
    die();
}; ?>

@extends('layouts.layout')

@section('content')
<h2>
    <?php if (isset($set)) {
        echo "<div id='confdiv'><a id='confirm' href='" . url("/confirm") . "?token=" . $set . "'>Na twoj mail zostalby wyslany link aktywacyjny gdyby strona byla postawiona na serwerze, a poki co kliknij tu zeby aktywowac konto</a></div>";
    }; ?>
    Breaking <span style="color: palevioletred;">Date</span></h2><br />
<form action="{{url('login')}}" method="post" id="formin">
    @csrf
    <p class="tip">Email:</p>
    <input type="text" id="logtext" name="email" /><br />
    <p class="tip">Haslo:</p>
    <input type="password" id="logpass" name="password" /><br />
    <?php if (isset($name)) {
        echo "<div id='logerr'>Podano bledny email lub haslo</div>";
    } ?>
    <button type="submit" id="logbutt" onclick="disappear(1)"><b>Zaloguj sie</b></button><br />
    <div id="lognoacc">Nie masz konta? <span onclick="disappear()" id="inregister">Zarejestruj sie</span></div>
</form>
@endsection

@section('skrypt')
<script>
    function ret(a) {
        a = a || null; //domyslny parametr dla IE
        if (a == 1) {
            document.getElementById('formin').submit();
        } else {
            window.open('<?php echo url('register') ?>', '_self');
        };
    }
</script>
@endsection


@section('css')
<style>
    #back {
        display: none;
    }

    #confirm {
        text-decoration: none;
        color: aqua;
    }

    #confdiv {
        margin-bottom: 2%;
        font-size: 1vw;
        letter-spacing: 0.2vw;
        pointer-events: initial;
        cursor: pointer;
    }

    #inregister {
        color: aqua;
        cursor: pointer;
    }
</style>
@endsection