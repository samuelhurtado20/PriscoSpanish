<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilProfesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_profesor', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->string('introText',255);
            $table->string('videoUrl',255);
            $table->string('about_short',150);
            $table->string('about',500);
            $table->string('completed_sessions',255);
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
        Schema::drop('perfil_profesor');
    }
}
