<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->increments('id');
            //$table->string('name');
            //$table->string('email')->unique();
            //$table->string('password', 60);
            //$table->rememberToken();
            //$table->timestamps();

            $table->string('apellido', 50);
            $table->boolean('sexo');
            $table->string('correo_notificaciones', 50); //correo para claves perdidas/ etc
            $table->integer('estatus')->default(0); // confirmado o no
            $table->string('direccion', 255);
            $table->string('ciudad', 40);
            $table->string('estado', 40);
            $table->string('codigo_postal', 10);
            $table->string('pais', 2); //esto seria un indice a una tabla de paises? usar ISo?
            $table->string('zona_horaria', 40); //UTC−04:30
            $table->string('contacto_skype', 50);
            $table->string('avatar');
            $table->boolean('profesor')->default(0); //si es profesor (solo asignable por admins)
            $table->string('profile_id', 255); //estudiar como generar uno unico /randomlib? .. puede ser un hash md5 del correo o el id + 100500 mientras
            $table->string('cod_confirmacion',32)->nullable(); // clave de confirmacion 
            									               //de correo (nulo es confirmado) solo los
            									               // que registran sin red social usan esto.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->dropColumn('descReserva');
            $table->dropColumn('apellido');
            $table->dropColumn('sexo');
            $table->dropColumn('correo_notificaciones');
            //$table->dropColumn('url_usuario');
            //$table->dropColumn('fecha_registro');
            $table->dropColumn('estatus');
            $table->dropColumn('direccion');
            $table->dropColumn('ciudad');
            $table->dropColumn('estado');
            $table->dropColumn('codigo_postal');
            $table->dropColumn('pais');
            $table->dropColumn('zona_horaria');
            $table->dropColumn('contacto_skype');
            //$table->dropColumn('idgoogle');
            //$table->dropColumn('idFacebook');
            //$table->dropColumn('url_perfil');
        });
    }
}
