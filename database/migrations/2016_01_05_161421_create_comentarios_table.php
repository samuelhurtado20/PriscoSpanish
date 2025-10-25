<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*
CREATE TABLE `tbl_comentarios` (
  `id_coment` int(10) NOT NULL AUTO_INCREMENT,
  `comentario` longtext COLLATE utf8_unicode_ci,
  `fecha_coment` date DEFAULT NULL,
  `hora_coment` time DEFAULT NULL,
  `id_usuario` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_coment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('comentario', 50);
            $table->date('fecha_coment');
            $table->time('hora_coment');
            $table->integer('id_usuario');
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
        Schema::drop('comentarios');
    }
}
