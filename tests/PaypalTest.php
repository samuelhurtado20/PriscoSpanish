<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaypalTest extends TestCase
{
     use WithoutMiddleware;
    
    /**
     * probar que se devuelve a la pagina de reservaciones
     * si se cancela la operacion de compra y
     * que se devuelve con el mensaje correcto
     * @return void
     */

    public function testPaymentRouteCancelled()
    {
        $this->call('GET', '/payment/status');
        $this->assertResponseStatus(302);
        //$this->assertRedirectedTo('reservations',array(),['token' => 'EC-9D796570XW041524L']); <- dio verde, esto no deberia estar aqui
        $this->assertRedirectedTo('reservations',array(),['error'=>'Payment failed']);
    }
    
    public function testPaymentRouteApproved()
    {
        $this->withSession(['paypal_payment_id' => '1111111111111']);
        $this->call('GET', '/payment/status',['token' => 'EC-9D796570XW041524L','PayerID'=>'9D796570XW041524L']);
        $this->assertResponseStatus(302);
        //exit();
        //$this->assertResponseStatus(302);
        //$this->assertSessionHas('paypal_payment_id', '1111111111111');
        //$this->assertRedirectedTo('reservations',array(),['success'=>'Payment success']);
    }
}
