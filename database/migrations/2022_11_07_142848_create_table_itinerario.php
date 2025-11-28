<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableItinerario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_itinerario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("id_empresa");
            $table->integer("id_sucursal");
            $table->integer("id_bus");
            $table->integer("id_asiento");
            $table->integer("id_cliente");
            $table->integer("id_chofer");
            $table->integer("id_chofer2");
            $table->integer("id_terramoza");
            $table->timestamp('fecha_salida')->nullable();
            $table->timestamp('fecha_llegada')->nullable();
            $table->integer('modalidad_id');
            $table->integer('usuario_id');
            $table->integer('estado')->default(1)->comment("0 = anulado, 1 = pendiente pago, 2 = confirmado, 3 = cambiado");
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
        Schema::dropIfExists('table_itinerario');
    }
}
