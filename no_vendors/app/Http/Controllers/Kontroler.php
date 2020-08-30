<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Postac;
use App\Oceny;

class Kontroler extends Controller
{
    public function postacie(Request $request) { //funkcja obslugujaca szukanie postaci
        if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
            return view('sites/index');
            die();
            };
        $str = $request->someName; //zapisywanie requesta do zmiennej
        $body = Controller::connect("all"); 
        foreach ($body as $char) {
            if ($str == $char["name"]) { //sprawdzanie czy nazwa szukanej postaci znajduje sie w bazie api
                $table["name"] = $char["name"];
                $table["img"] = $char["img"];
                $table["id"] = $char["char_id"];
                $vare = DB::table('oceny')->where('numer', $char["char_id"])->where('email', $_COOKIE["mail"])->exists(); //sprawdzenie czy postac zostala juz oceniona
                if ($vare) {
                    $oceny = Oceny::all(); //pobranie ocen z bazy
                    $table["ocena"] = json_decode(DB::table('oceny')->where('numer', $char["char_id"])->where('email', $_COOKIE["mail"])->get('ocena'), true)[0]["ocena"]; //wczytanie oceny
                }
                return view('sites/profil', compact("table"));
            };
        };
    	return view('sites/search')->with('notfound', '1'); //zwrot jesli nie znaleziono
    }

    public function random() { //funkcja losowania postaci
        if (!isset($_COOKIE["token"]) && !isset($token)) { //sprawdzenie czy uzytkownik jest zalogowany
            return view('sites/index');
            die();
            };
        $body = Controller::connect("random");
        $table["name"] = $body[0]["name"];
        $table["img"] = $body[0]["img"];
        $table["id"] = $body[0]["char_id"];
        $vare = DB::table('oceny')->where('numer', $body[0]["char_id"])->where('email', $_COOKIE["mail"])->exists(); //sprawdzenie czy postac zostala juz oceniona
        if ($vare) {
            $oceny = Oceny::all(); //pobranie ocen z bazy
            $table["ocena"] = json_decode(DB::table('oceny')->where('numer', $body[0]["char_id"])->where('email', $_COOKIE["mail"])->get('ocena'), true)[0]["ocena"]; //wczytanie oceny
        };
        return view('sites/profil', compact("table"));
    }
}
