<?php
namespace App;

/* 
 * Constantes que se usan para las sesiones.
 * se ha definido en una clase para porder agregarlas
 * solo donde sea necesario.
 */
class SessionConstants{
    
    public static function STATUSES(){
        return [
                '107'=>'Canceled',
                '108'=>'Upcomming',
                '109'=>'discussion',
                '110'=>'Completed',
                '111'=>'pending',
                '120'=>'dispute',
        ];
    }
}
