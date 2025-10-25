<?php
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder{
    //id, txnid, payment_amount, payment_status, itemid, created_at, updated_at
   public function run()
    {
        DB::table('payments')->insert([
            'txnid' => '1',
            'payment_amount' => '10',
            'payment_status' => 'ok',
            'itemid' => '1'
        ]);
        
    }
}
