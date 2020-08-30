<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Konta;

class Logowanie extends Controller
{
    public function sprawdz(Request $table) { //funkcja obslugujaca logowanie
        $data = json_decode(Konta::all(), true);
        foreach ($data as $val) {
            if ($table["email"] == $val["email"] && $table["password"] == $val["password"] && $val["token"] == "activated") { //sprawdzanie hasla, emaila i czy konto jest aktywne
                setcookie("token", $table["_token"], time()+1800);
                setcookie("mail", $table["email"], time()+1800);
                return view('sites/sympatie')->with('token', 'value'); //ustawianie ciasteczek ze uzytkownik jest zalogowany
            };
        };
        $wartosc = 1;
        return view('sites/index')->with('name', 'value'); //zwrot z bledem
    }

    public function register(Request $table) { //funkcja obslugujaca rejestracje
        $data = json_decode(Konta::all(), true);
        foreach ($data as $val) {
            if ($table["email"] == $val["email"]) {
                return view('sites/register')->with('name2', 'value'); //zwrot bledu jesli email jest juz zarejestrowany
            };
        };
        $new = new Konta;
        $new->email=$table["email"];
        $new->password=$table["password"];
        $a = rand ( 100000 , 999999 );
        $b=$rand = substr(md5(microtime()),rand(0,26),10);
        $c = rand ( 100000 , 999999 ); //tworzenie tokena do potwierdzenia maila
        $token = $a.$b.$c;
        $new->token=$token;
        $new->save(); //dodawanie konta do bazy danych
        return view('sites/index')->with('set', $token); //zwrot z informacja o potwierdzeniu maila
    }

    public function confirm() {
        if (!isset($_GET['token']) || $_GET['token'] == "activated") {header("Location: /");die();} else {
            $data = json_decode(Konta::all(), true);
            foreach ($data as $val) {
                if ($_GET['token'] == $val["token"]) {
                    $affected = DB::table('konta')->where('email', $val["email"])->update(['token' => "activated"]);
                    return "<h1><a href='".url("/")."'>Email zostal aktywowany. Wroc na strone logowania</a></h1>";
                };
            };
        }
        header("Location: /");die();
    }
}