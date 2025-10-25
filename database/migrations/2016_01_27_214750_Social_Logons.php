<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SocialLogons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	  Schema::create('SocialLogons', function (Blueprint $table) {
         	$table->increments('id');
          	//$table->string('name');
          	//$table->string('username')->nullable();
          	//$table->string('email')->nullable();
          	//$table->string('avatar');
          	$table->string('provider');
          	$table->string('provider_id')->unique();
          	$table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('SocialLogons');
    }
}
