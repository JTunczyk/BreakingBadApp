<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OcenaAktora extends Migration //migracja bazy danych z ocenami postaci
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oceny', function (Blueprint $table) {
            $table->id();
            $table->String("email");
            $table->String("numer");
            $table->String("ocena");
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
        Schema::dropIfExists('oceny');
    }
}
