<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_languages', function (Blueprint $table) {
            // no queremos una persona con el mismo idioma registrado mas de una vez
             $table->index(['idusuario', 'idioma'])->unique(); 
             $table->integer('idusuario');
             $table->string('idioma');
             $table->smallInteger('nivel')->default(0);
             $table->boolean('primario')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_languages');
    }
}
