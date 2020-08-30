<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sites/index'); //strona glowna
});

Route::get('/postacie', function () {
    return view('sites/index'); //obsluguje post nizej, get dla pewnosci ze nie wyrzuci bledu
});

Route::get('/register', function () {
    return view('sites/register'); //strona z rejestracja
});

Route::get('/sympatie', function () {
    return view('sites/sympatie'); //menu
});

Route::get('/login', function () {
    return view('sites/index'); //obsluguje post nizej, get dla pewnosci ze nie wyrzuci bledu
});

Route::get('/search', function () {
    return view('sites/search'); //wyszukiwarka postaci
});

Route::get('/confirm', 'Logowanie@confirm'); //potwierdzenie emaila tokenem przez get

Route::get('/wczytaj', 'KontrolerOcen@wczytaj'); //ocenione do tej pory postacie

Route::get('/losuj', "Kontroler@random"); //losowa postac

Route::post('/losuj', "KontrolerOcen@zapisz"); //zapisanie oceny

Route::post('/login', "Logowanie@sprawdz"); //logowanie

Route::post('/postacie', 'Kontroler@postacie'); //wyswietlenie danej postaci

Route::post('/register', 'Logowanie@register'); //kontroler rejestracji