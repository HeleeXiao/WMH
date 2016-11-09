<?php

use Illuminate\Database\Seeder;

class BrowsesTableSeeder extends Seeder
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
        $user = \App\Models\User::where("state",0)->get()->pluck("id")->toArray();
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id")->toArray();
        foreach ($user as $value)
        {
            \App\Models\Browse::firstOrCreate([
                "user_id"   => $value,
                "demand_id" => array_rand( $demands ),
            ]);
        }
    }

}
