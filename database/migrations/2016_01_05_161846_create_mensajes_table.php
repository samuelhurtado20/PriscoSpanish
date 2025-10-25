<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
CREATE TABLE `tbl_mensajes` (
  `idMsg` int(100) NOT NULL AUTO_INCREMENT,
  `asuntoMensaje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuerpoMensaje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hora` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaRegistro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaRegistro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datoUsuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(2) DEFAULT NULL,
  PRIMARY KEY (`idMsg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     * Mensajes privados entre usuarios del sistema
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('previous_message_id'); //id de mensaje previo, campo auto referencial para permitir cadenas de mensaje
            $table->integer('user_id_destino');
            $table->integer('user_id_origen');
            $table->string('asuntoMensaje', 255);
            $table->string('cuerpoMensaje', 255);
            $table->string('datoUsuario', 255);
            $table->integer('leido');
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
        Schema::drop('mensajes');
    }
}
