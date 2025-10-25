<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
CREATE TABLE `timezone` (
  `tzid` int(11) NOT NULL AUTO_INCREMENT,
  `tzciudad` varchar(35) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tzcodigo` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tzgmthora` varchar(35) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tzgmt` decimal(6,2) NOT NULL DEFAULT '0.00',
  `tztimezone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Zonas de PHP',
  `tzfecreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tzid`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/
class CreateTimezoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tzciudad', 255);
            $table->string('tzcodigo', 5);
            $table->string('tzgmthora', 35);
            $table->decimal('payment_amount', 6, 2);
            $table->string('tztimezone', 50);
            $table->timestamp('tzfecreg');
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
        Schema::drop('timezone');
    }
}
