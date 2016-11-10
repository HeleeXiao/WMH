<?php

use Illuminate\Database\Seeder;

class TagDemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(" create TagDemand loading ... ");
        $this->default_();
    }

    protected function default_()
    {
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id");
        $tags  = \App\Models\Tag::where("state",0)->get()->pluck("id");
        foreach ($demands as $id) {
            $tagA = array_rand($tags->toArray(),6);
            foreach ($tagA as $tag_id) {
                \App\Models\TagDemand::firstOrCreate([
                    "demand_id"     => $id,
                    "tag_id"        => $tag_id,
                ]);
            }
        }
    }
}
