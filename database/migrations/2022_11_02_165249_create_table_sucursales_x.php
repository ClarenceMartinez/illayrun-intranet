<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSucursalesX extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('empresa_id');
            $table->string('nombre_comercial');
            $table->integer('tipo_documento');
            $table->string('numero_documento');
            $table->string('razon_social');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('email');
            $table->integer('departamento_id');
            $table->integer('provincia_id');
            $table->integer('distrito_id');
            $table->string('latitud');
            $table->string('longitud');
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
        Schema::dropIfExists('table_sucursales_x');
    }
}
