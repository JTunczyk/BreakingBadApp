<?php if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
    header("Location: /");
    die();
}; ?>

@extends('layouts.layout')

@section('content')
<form action="{{url('postacie')}}" id="formid" method="post">
    @csrf
    <input id="searchtext" name="someName" /><img id="lupa" onclick="document.getElementById('formid').submit();" src="/images/lupa.png" />
</form>
<?php if (isset($notfound)) {
    echo "<br/><span style='font-size: 3vw; color: red'>Nie znaleziono</span>";
}; ?>
@endsection

@section('skrypt')
<script>
    var x = document.createElement("IMG");
    x.setAttribute("src", "/images/lupa.png");


    function ret() {
        window.open('<?php echo url('sympatie') ?>', '_self');
    };
</script>
@endsection