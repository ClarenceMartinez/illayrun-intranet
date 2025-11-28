<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->renameColumn('nombre', 'nombres');
            $table->renameColumn('fecha_de_nacimiento', 'fecha_nacimiento');
            $table->renameColumn('direccion', 'nacionalidad');
            $table->string('paterno')->after('nombres');
            $table->string('materno')->after('nombres');
            $table->string('es_nino')->after('fecha_nacimiento');
            $table->string('sexo')->after('materno');
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
