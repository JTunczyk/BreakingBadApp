<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UtworzKonta extends Migration //migracja bazy danych z kontami uzytkownikow
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konta', function (Blueprint $table) {
            $table->id();
            $table->String("email");
            $table->String("password");
            $table->String("token");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konta');
    }
}
