<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
CREATE TABLE `tbl_lecciones_gratis` (
  `idVideo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlVideo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlImg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tituloVideo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateLeccionesGratisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecciones_gratis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idVideo', 255);
            $table->string('urlVideo', 255);
            $table->string('urlImg', 255);
            $table->string('tituloVideo', 255);
            $table->string('categoria', 255);
            $table->string('nivel', 255);
            $table->timestamp('fechaRegistro');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lecciones_gratis');
    }
}
