<?php



use Illuminate\Database\Seeder;


class LearningSessionsTableSeeder extends Seeder {
  
    public function run()
    {
        DB::table('learning_sessions')->insert([
            'payment_id'=>'1',
            'user_id' => '1',
            'teacher_id' => '1',
            'session_offer_id' => '1',
            'language' => 'ES',
            'start' => '2017-01-01 00:00:00',
            'end' => '2017-01-01 00:30:00',
            'price' => '20.00',
            'teacher_status_update' => '0000-00-00 00:00:00',
            'new_status_teacher' => '',
            'user_status_update' => '0000-00-00 00:00:00',
            'new_status_user' => '',
            'status' => '',
        ]);       
    }
     
    
}
