<?php

use Illuminate\Database\Seeder;

class TagUsersTableSeeder extends Seeder
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
        $users = \App\Models\User::where("state",0)->get()->pluck("id");
        $tags  = \App\Models\Tag::where("state",0)->get()->pluck("id");
        foreach ($users as $id) {
            $tagA = array_rand($tags->toArray(),6);
            foreach ($tagA as $tag_id) {
                \App\Models\TagUser::firstOrCreate([
                    "user_id"   => $id,
                    "tag_id"    => $tag_id,
                ]);
            }
        }
    }
}
