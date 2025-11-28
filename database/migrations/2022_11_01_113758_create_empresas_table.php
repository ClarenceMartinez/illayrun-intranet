<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_comercial');
            $table->integer('tipo_documento');
            $table->string('numero_documento');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('telefono_1');
            $table->string('telefono_2');
            $table->string('email');
            $table->string('pais');
            $table->integer('estado');
            $table->string('tipo_membresia');
            $table->decimal('monto_membresia');
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
        Schema::dropIfExists('empresas');
    }
}
