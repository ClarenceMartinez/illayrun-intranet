<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('detalleventa_id');
            $table->integer("venta_id");
            $table->integer("sucursal_id");
            $table->integer("cliente_id")->nullable()->default(1);
            $table->string("concepto")->nullable()->default("");
            $table->string("descripcion")->nullable()->default("");
            $table->decimal("precio_unitario")->nullable()->default(0);
            $table->decimal("precio_total")->nullable()->default(0);
            $table->integer("cantidad")->nullable()->default(0);
            $table->integer("n_asiento")->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
