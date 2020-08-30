<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static function connect($a = "all") //funkcja do laczenia sie z api, uzywana w paru kontrolerach wiec zdeklarowana tutaj
    {
        while (!isset($x[0])) { //probowanie poki sie nie uda
            $client = new Client();
            if ($a == "random") {
                $response = $client->request('GET', 'https://www.breakingbadapi.com/api/characters/'.strval(rand(1, 63)), ['verify' => false]); // verify jest ustawione na false bo robilem to lokalnie
            } else if ($a == "all") {
                $response = $client->request('GET', 'https://www.breakingbadapi.com/api/characters/', ['verify' => false]); // jak wyzej
            } else {
                return null;
            }
            $statusCode = $response->getStatusCode();
            $x = json_decode($response->getBody()->getContents(), true); // zamiana stringa na array
        }
        return $x;
    }
}
