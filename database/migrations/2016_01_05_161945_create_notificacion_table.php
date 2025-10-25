<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
CREATE TABLE `tbl_notificacion` (
  `id_notificacion` int(10) NOT NULL AUTO_INCREMENT,
  `correo_usuario` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo_notif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc_notif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaRegistro` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horaRegistro` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_destino` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'este campo esta relacionado con otras tablas',
  `nameTabla` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre de la tabla de la cual extraera datos',
  `estatus` int(1) DEFAULT NULL COMMENT 'determina si la notificacion ya esta leida o no',
  PRIMARY KEY (`id_notificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     * las notificaciones van del sistema al usuario
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_destino');
            $table->string('correo_usuario', 150);
            $table->string('titulo', 150);
            $table->string('contenido', 255);
            $table->boolean('leida')->default(0);
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
        Schema::drop('notificacion');
    }
}
