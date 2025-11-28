<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableItinerario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itinerario', function (Blueprint $table) {
            $table->integer('origen_id')->before('destino_id');
            $table->integer('hora_partida')->after('fecha_llegada');
            $table->integer('hora_llegada')->after('hora_partida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
