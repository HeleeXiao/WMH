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
        for($i=0 ; $i<51 ; $i++)
        {
            $user = factory(\App\Models\User::class)->create();
            \App\Models\UserContent::firstOrCreate(['user_id' => $user->id]);
            \Illuminate\Support\Facades\Event::fire(
                new \App\Events\RegisterEvent($user)
            );
            ;
        }
    }

}
