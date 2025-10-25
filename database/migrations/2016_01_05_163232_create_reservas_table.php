<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
CREATE TABLE `tbl_reservas` (
  `nReserva` int(10) NOT NULL AUTO_INCREMENT,
  `descReserva` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formatoLargoDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zona_h` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCorta` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `datoUsuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactoSkype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlDestino` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tiempoLeccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tiempoLeccionAdmin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estatusLeccion` int(1) DEFAULT NULL COMMENT 'Estado de lecciones\r\n\r\nPENDIENTES: 1 - TOMADAS: 2, CANCELADAS: 0',
  PRIMARY KEY (`nReserva`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descReserva', 255);
            $table->string('formatoLargoDate', 255);
            $table->string('zona_h', 50);
            $table->string('fechaCorta', 20);
            $table->string('hora', 255);
            $table->dateTime('fechaRegistro');
            $table->string('datoUsuario', 255);
            $table->string('contactoSkype', 255);
            $table->string('urlDestino', 255);
            $table->string('tiempoLeccion', 255);
            $table->string('tiempoLeccionAdmin', 255);
            $table->integer('estatusLeccion');
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
        Schema::drop('reservas');
    }
}
