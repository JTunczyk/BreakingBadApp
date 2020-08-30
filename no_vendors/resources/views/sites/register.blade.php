<?php if (isset($_COOKIE["token"]) || isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /sympatie");
    die();
}; ?>

@extends('layouts.layout')

@section('skrypt')
<script>
    function check(x, y) {
        let turn = false;
        let blad = document.getElementsByClassName("blad");
        let przycisk = document.getElementById("regbutt").disabled;
        switch (x) {
            case 1:
                if ((y.indexOf("@") < 0 || y.indexOf(".") < 0) || /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(y)) {
                    turn = false;
                } else {
                    turn = true;
                }
                break;
            case 2:
                if (y.length < 6) {
                    turn = false;
                } else {
                    turn = true;
                }
                break;
            case 3:
                if (document.getElementById("haslo2").value != document.getElementById("haslo").value) {
                    turn = false;
                    document.getElementById("dr").style.display = "none";
                } else {
                    turn = true;
                    document.getElementById("dr").style.display = "block";
                }
                break;
            default:
                return null
                break;
        }
        if ((document.getElementById("logtext").value.indexOf("@") < 0 || document.getElementById("logtext").value.indexOf(".") < 0) || /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(y) || y != document.getElementById("haslo").value || y.length < 6) {
            document.getElementById("regbutt").disabled = true;
        } else {
            document.getElementById("regbutt").disabled = false;
        }
        console.log(blad[x - 1]);
        turn == false ? blad[x - 1].style.display = "block" : blad[x - 1].style.display = "none";
    }
</script>
@endsection

@section('css')
<style>
    #haslo2 {
        margin-bottom: 10%;
        width: 16vw;
        line-height: 1.5vw;
        text-align: center;
    }

    #haslo {
        margin-bottom: 5%;
        width: 16vw;
        line-height: 1.5vw;
        text-align: center;
    }

    #regbutt {
        text-transform: none;
        margin-bottom: 5%;
        width: 10vw;
        height: 1.5vw;
        cursor: pointer;
    }

    #reglogin {
        color: aqua;
        cursor: pointer;
    }

    #logtext {
        margin-bottom: 5%;
        width: 20vw;
        line-height: 1.8vw;
        text-align: center;
    }

    #bladid {
        margin-top: -8%;
    }

    #back {
        display: none;
    }

    #inregister {
        color: aqua;
        cursor: pointer;
    }

    #inUse {
        text-decoration: none;
        color: red;
    }

    #confdiv {
        margin-bottom: 2%;
        font-size: 1vw;
        letter-spacing: 0.2vw;
        pointer-events: initial;
        cursor: pointer;
    }
</style>
@endsection


@section('content')
<h2>
    <?php if (isset($name2)) {
        echo "<div id='confdiv'><span id='inUse''>Email jest juz zajety</span></div>";
    }; ?>
    Rejestracja<br />
    <form action="{{url('register')}}" method="post">
</h2><br />
@csrf
<p class="tip">Email:</p>
<input type="text" id="logtext" onchange="check(1, this.value)" name="email" />
<p class="blad">Podaj poprawny Email</p>
<p class="tip">Haslo:</p>
<input type="password" onchange="check(2, this.value)" name="password" class="regpass" id="haslo" />
<p class="blad">Haslo musi byc dluzsze niz 6 znakow</p>
<p class="tip">Potwierdz haslo:</p>
<input type="password" onchange="check(3, this.value)" class="regpass" id="haslo2" />
<p class="blad" id="bladid">Hasla roznia sie</p>
<br id="dr" />
<button type="submit" disabled="true" id="regbutt"><b>Zarejestruj sie</b></button><br />
<div id="lognoacc">Masz juz konto? <span onclick="disappear()" id="inregister">Zaloguj sie</span></div>
</form>
@endsection