<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');//uno a uno contra usuario
            $table->integer('lessons_attended');
            $table->integer('lessons_goal');
            $table->integer('exams_attended');
            $table->integer('exams_goal');
            $table->integer('private_sessions_attended');
            $table->integer('private_sessions_goal');
            $table->integer('group_sessions_attended');
            $table->integer('group_sessions_goal');
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
        Schema::drop('goals');
    }
}
