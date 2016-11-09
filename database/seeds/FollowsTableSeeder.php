<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->default_();
    }

    protected function default_()
    {
        $users   = \App\Models\User::where("state",0)->get()->pluck("id");
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id");

        foreach ($users->toArray() as $user_id) {
            for($i = 0;$i < rand(2,6);$i++)
            {
                $cover_user_id = array_rand($users->toArray());
                \App\Models\Follow::firstOrCreate([
                    "user_id"   => $user_id,
                    "cover_user_id"   => $cover_user_id == $user_id ? array_rand($users->toArray()) : $cover_user_id,
                ]);
                \App\Models\Follow::firstOrCreate([
                    "user_id"   => $user_id,
                    "demand_id"   => array_rand($demands->toArray()),
                ]);
            }
        }

    }
}
