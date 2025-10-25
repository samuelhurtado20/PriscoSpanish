<?php


use Illuminate\Database\Seeder;

class SessionOffersTableSeeder extends Seeder {
    public function run()
    {
        DB::table('session_offers')->insert([
            'usuario' => '1',
            'idioma' => 'Spanish',
            'nombre' => 'Sesion de Espanol',
            'descripcion' => 'Esta es una sesion de pruebas',
            'precio_individual_20' => '10.00',
            'precio_individual_30' => '0',
            'precio_individual_60' => '50.00',
            'precio_paquete_a' => '0',
            'precio_paquete_b' => '100.00',
        ]);
        
    }
     
    
}
