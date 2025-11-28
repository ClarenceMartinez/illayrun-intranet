<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEncomiendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('encomiendas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id');
            $table->bigInteger('sucursal_id');
            $table->bigInteger('remitente_tipo_documento');
            $table->string('remitente_numero_documento');
            $table->string('remitente_nombres');
            $table->string('remitente_paternos');
            $table->string('remitente_maternos');
            $table->string('remitente_celular');
            $table->bigInteger('consignado_tipo_documento');
            $table->string('consignado_numero_documento');
            $table->string('consignado_nombres');
            $table->string('consignado_paternos');
            $table->string('consignado_maternos');
            $table->string('consignado_celular');
            $table->date('fecha_envio');
            $table->bigInteger('itinerario_id');
            $table->string('sucursal_destino');
            $table->string('contrasenia');
            $table->enum('forma_pago', ['efectivo','pos']);
            $table->enum('comprobante', ['BOLETA','FACTURA']);
            $table->string('correlativo');
            $table->decimal('totalgravada')->default(0);
            $table->decimal('totalexonerada')->default(0);
            $table->decimal('totaligv')->default(0);
            $table->decimal('totalventa')->default(0);
            $table->decimal('moneda')->default(0);
            $table->integer('estado')->default(0);
            $table->string('pdf')->default(0);
            $table->string('xml_cpe')->default(0);
            $table->string('xml_cdr')->default(0);
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
        Schema::dropIfExists('encomiendas');
    }
}
