<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("empresa_id");
            $table->integer("sucursal_id");
            $table->string("nombre");
            $table->integer("tipo_documento");
            $table->string("numero_documento");
            $table->string("telefono");
            $table->string("direccion");
            $table->string("email");
            $table->date("fecha_de_nacimiento");
            $table->integer("estado")->default(1);
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
        //
    }
}
