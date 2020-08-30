<?php if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /");
    die();
}; ?>

@extends('layouts.layout')

@section('content')
<img id="profilimg" src="{{$table['img']}}" onerror="this.onerror=null;this.src='/images/noimg.png';" /><br />
<h3>{{$table['name']}}</h3>
<span id="qwerty"></span>
<img id="lupa2" src="/images/lupa.png" onclick="disappear(1)" />
<img src="/images/heartr.png" id="serce" />
<img id="kostka" onclick="disappear()" src="/images/dice.png" />
@endsection

@section('css')
<style>
    #serce:hover,
    #lupa:hover,
    #kostka:hover {
        cursor: pointer;
        background-color: lime !important;
        opacity: 0.8;
    }

    #kostka {
        cursor: pointer;
        width: 10%;
        height: 20%;
        border-radius: 25%;
        background-color: white;
    }

    #serce {
        border-radius: 25%;
        background-color: white;
        width: 20%;
        height: 40%;
        background-size: cover;
    }

    #lupa2 {
        cursor: pointer;
        width: 10%;
        height: 20%;
        border-radius: 25%;
        background-color: white;
    }
</style>
@endsection


@section('skrypt')
<script>
    function gradeUpdate(x, a) {
        a = a || null; //domyslny parametr dla IE
        if (a == null) {
            document.getElementById("serce").style.background = "linear-gradient(0deg, rgba(255,0,0,1) " + x + "%, rgba(255,255,255,1) " + x + "%)";
        } else {
            document.getElementById("serce").style.background = "linear-gradient(0deg, rgba(76,16,16,1) " + x + "%, rgba(255,255,255,1) " + x + "%)";
        }
        let tekst = document.getElementById("qwerty");
        tekst.innerHTML = ("Moj typ w " + x + "%");
        tekst.style.display = "block";
    }

    <?php
    if (isset($table["ocena"])) {
        echo "window.grade = " . strval($table["ocena"]) . ";";
        echo "document.getElementById('serce').addEventListener('mouseout', function(event) {gradeUpdate(window.grade, 3)});";
        echo "gradeUpdate(window.grade, 5);";
    } else {
        echo "document.getElementById('serce').addEventListener('mouseout', function(event) {document.getElementById('qwerty').style.display = 'none'; document.getElementById('serce').style.background = 'white';});";
    }

    ?>

    document.getElementById("serce").addEventListener("mousemove", function(event) {
        window.x = 100 - (Math.floor(((event.pageY - document.getElementById("serce").getBoundingClientRect().top) / (document.getElementById("serce").getBoundingClientRect().height)) * 10) * 10);
        if (window.x < 0) {
            window.x = 0
        };
        if (window.x > 100) {
            window.x = 100
        };
        gradeUpdate(window.x);
    })

    document.getElementById("serce").addEventListener("click", function(event) {
        disappear(2);
    })

    function ret(a) {
        a = a || null; //domyslny parametr dla IE
        if (a == 2) {
            document.getElementById("container").remove();
            document.getElementById("back").remove();
            document.body.innerHTML += '<form id="formib" action="<?php echo url("losuj"); ?>" method="post">@csrf<input type="hidden" name="somename" value="' + window.x + '"><input type="hidden" name="id" value="{{$table['id']}}"></form>';
            document.getElementById("formib").submit();
        } else if (a == 1) {
            window.open('<?php echo url('search') ?>', '_self');
        } else {
            window.open('<?php echo url('losuj') ?>', '_self');
        };
    }
</script>
@endsection