<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("empresa_id");
            $table->integer("usuario");
            $table->enum("tuc",["yes","no"]);
            $table->date("fecha_emision_tuc");
            $table->date("fecha_vencimiento_tuc");       
            $table->string("marca");   
            $table->enum("citv",["yes","no"]);   
            $table->date("ultimo_citv"); 
            $table->enum("soat",["yes","no"]); 
            $table->date("fecha_emision_soat"); 
            $table->date("fecha_vencimiento_soat"); 
            $table->string("placa"); 
            $table->enum("carroceria_original",["yes","no"]); 
            $table->enum("tiv_fisico",["yes","no"]); 
            $table->enum("tiv_electronica",["yes","no"]); 
            $table->date("fecha_emision_tiv"); 
            $table->date("fecha_vencimiento_tiv"); 
            $table->string("categoria"); 
            $table->string("pad"); 
            $table->integer("estado"); 
            $table->enum("tarjeta_propiedad",["yes","no"]); 
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
        Schema::dropIfExists('buses');
    }
}
