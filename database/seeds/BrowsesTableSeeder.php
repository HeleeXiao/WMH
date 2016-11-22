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
        $this->command->info(" create Browses loading ... ");
        $this->default_();
    }

    protected function default_()
    {
        $user = \App\Models\User::where("state",0)->get()->pluck("id")->toArray();
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id")->toArray();
        $tags  = \App\Models\Tag::where("state",0)->get()->pluck("id");
        foreach ($user as $value)
        {
            $tagA = array_rand($tags->toArray(),4);

            foreach ($tagA as $tag_id) {
                \App\Models\Browse::firstOrCreate([
                    "user_id"   => $value,
                    "tag_id" => $tag_id,
                ]);
                \App\Models\Browse::firstOrCreate([
                    "user_id"   => $value,
                    "demand_id" => $demands[array_rand( $demands )],
                ]);
            }
        }
    }

}
