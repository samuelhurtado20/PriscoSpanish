<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario'); 
            $table->string('idioma');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio_individual_20', 7, 2);
            $table->decimal('precio_individual_30', 7, 2);
            $table->decimal('precio_individual_60', 7, 2);
            $table->decimal('precio_paquete_a', 7, 2);
            $table->decimal('precio_paquete_b', 7, 2);
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
       Schema::drop('session_offers');
    }
}
