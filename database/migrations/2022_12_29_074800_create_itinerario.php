<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerario', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer("empresa_id");
            $table->integer("sucursal_id");
            $table->integer("bus_id");
            $table->integer("chofer_id");
            $table->integer("chofer2_id")->nullable();
            $table->integer("terramoza_id");
            $table->integer("terramoza2_id")->nullable();
            $table->date('fecha_partida')->nullable();
            $table->date('fecha_llegada')->nullable();
            $table->integer("destino_id")->nullable();;
            $table->integer('usuario_id');
            $table->integer('sucursal_partida')->nullable();
            $table->integer('sucursal_destino')->nullable();
            $table->integer('estado')->default(1)->comment("0 = anulado, 1 = pendiente pago, 2 = confirmado, 3 = cambiado");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itinerario');
    }
}
