<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('venta_id');
            $table->integer("empresa_id");
            $table->integer("sucursal_id");
            $table->integer("cliente_id");
            $table->integer("itinerario_id");
            $table->integer("codcaja");
            //$table->integer("codarqueo"); ///
            $table->integer("n_asiento");
            $table->integer("embarque_origen_id")->nullable();
            $table->integer("embarque_destino_id")->nullable();
            $table->integer('is_nino')->default(0)->comment("0 = adulto, 1 = nino");
            $table->string("tipo");
            $table->integer("usuario_id")->nullable();
            $table->date('fecha_reserva')->nullable();
            $table->date('fecha_venta')->nullable();
            $table->integer('estado')->default(1)->comment("0 = anulado, 1 = activo");
            $table->decimal('totalpago')->default(0);
            $table->decimal('montopagado')->default(0);
            $table->decimal('montodevuelto')->default(0);
            $table->decimal('montoefectivo')->default(0);
            $table->decimal('totalgravada')->default(0);
            $table->decimal('totalexonerada')->default(0);
            $table->decimal('totaligv')->default(0);
            $table->decimal('totalventa')->default(0);
            $table->decimal('moneda')->default(0);
            $table->string('statusventa')->default(0);
            $table->string('pdf')->default(0);
            $table->string('xml_cpe')->default(0);
            $table->string('xml_cdr')->default(0);
            $table->string('mensaje')->default(0);
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
        Schema::dropIfExists('ventas');
    }
}
