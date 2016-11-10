<?php
use Illuminate\Database\Seeder;

class DiscussTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(" create Discuss loading ... ");
        $this->default_();
        $this->default_(1);
    }

    protected function default_($type=0)
    {
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id");
        $user = \App\Models\User::where("state",0)->get()->pluck("id")->toArray();
        $tags = \App\Models\Tag::all()->pluck("name")->toArray();
        $ARF = ['~',"!",'@','#','$','%','^','&','*'];

        foreach ($demands as $value) {
            $discuss_id = \App\Models\Discus::firstOrCreate([
                'content'   => array_rand($tags)." ".array_rand($ARF).array_rand($tags)." ".array_rand($ARF).
                    array_rand($tags)." ".array_rand($ARF).
                    array_rand($tags)." ".array_rand($ARF).
                    array_rand($tags)." ".array_rand($ARF),
                "user_id"   => array_rand( $user ),
                "demand_id" => $value,
                "type"      => $type
            ])->id;
            if( ! $type ) {
                $child_discuss_id = [];
                for ($i = 0; $i < 3; $i++) {
                    $child_discuss_id[] = \App\Models\Discus::firstOrCreate([
                        'content' => array_rand($tags)." ".array_rand($ARF).array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF),
                        "user_id" => array_rand($user),
                        "parent_id" => $discuss_id
                    ])->id;
                }

                foreach ($child_discuss_id as $child_value) {
                    \App\Models\Discus::firstOrCreate([
                        'content' =>
                            array_rand($tags)." ".array_rand($ARF).array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF).
                            array_rand($tags)." ".array_rand($ARF),
                        "user_id" => array_rand($user),
                        "parent_id" => $child_value
                    ]);
                }
            }
        }
    }
}
