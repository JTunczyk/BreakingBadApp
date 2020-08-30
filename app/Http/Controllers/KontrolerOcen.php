<?php

namespace App\Http\Controllers;

use App\Oceny;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KontrolerOcen extends Controller
{
    public function zapisz(Request $vart) //funkcja do zapisywania oceny
    {
        if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
            return view('sites/index');
            die();
            };
        $dane = new Oceny;
        $dane->email = $_COOKIE["mail"];
        $dane->numer = $vart["id"];
        $dane->ocena = $vart["somename"];
        if (DB::table('oceny')->where('numer', $dane->numer)->where('email', $dane->email)->exists()) { //sprawdzanie czy ocena istnieje
            $edit = DB::table('oceny')->where('numer', $dane->numer)->where('email', $dane->email)->update(['ocena' => $dane->ocena]); //aktualizowanie oceny
        } else {
        $dane->save(); //zapis do bazy danych
        }
        $body = Controller::connect("random"); 
        $table["name"] = $body[0]["name"];
        $table["img"] = $body[0]["img"];
        $table["id"] = $body[0]["char_id"];
        return view('sites/profil', compact("table")); //losowanie kolejnej postaci
    }

    public function wczytaj() //funkcja wczytujaca "moje sympatie"
    {
        if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
            return view('sites/index');
            die();
            };
        $body = Controller::connect("all");
        $test = [];
        $end = [];
        $oceny = Oceny::all();
        foreach ($oceny as $char) {
            if (!in_array($char->numer, $test) && $char->email == $_COOKIE["mail"] && is_numeric($char->numer) && is_numeric($char->ocena)) { // upewnienie sie ze nie znajduje sie jakis string, undefined lub wartosc sie nie powtarza
                array_push($test, $char->numer);
                $page = (object)[];
                $page->first = $body[$char->numer - 1]["name"];
                $page->third = $body[$char->numer - 1]["img"];
                $page->second = strval($char->ocena) . "%";
                array_push($end, $page); //dodawanie do tabeli postaci
            }
        };
        return view('sites/favorites', compact("end")); //przeslanie tabeli do widoku
    }
}
