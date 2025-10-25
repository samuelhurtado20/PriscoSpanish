<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Gus',
            'email' => 'elmail@elamil.com',
            'password' => bcrypt('123456'),
            'estatus' => 1,
        ]);
        
    }
}
