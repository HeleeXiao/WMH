<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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

        $tags = [
            "都市","言情",'古典','名著','诗歌','传记','连环画','小人书','政治','战争','科技','生物','化学',
            "唯美","首都",'大学','青春','养生','感动','传世','感恩','动作','爱情','奥斯卡','诺贝尔',
        ];

        foreach ($tags as $value) {
            \App\Models\Tag::firstOrCreate(["name"=>$value]);
        }

    }
}
