<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('session_offer_id')->unsigned();
            $table->string('language');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('price', 7, 2);
            $table->dateTime('teacher_status_update');
            $table->integer('new_status_teacher');
            $table->dateTime('user_status_update');
            $table->integer('new_status_user');
            $table->integer('status');
            $table->timestamps();
        });
        
        //se agregan las claves foraneas para evitar conflictos
        Schema::table('learning_sessions', function($table) {
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('RESTRICT');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->foreign('session_offer_id')->references('id')->on('session_offers')->onDelete('RESTRICT');//no se puede borrar una oferta que tenga sessiones activas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('learning_sessions');
    }
}
