<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(" create Files loading ... ");
        foreach ($this->default_() as $value) {
            \App\Models\File::firstOrCreate($value);
        }

    }

    protected function default_()
    {
        return [
            [
                "path" => "http://www.fzlu.com/uploads/allimg/121112/1-121112145010531.jpg" ,
                "token"     => get_token(),
                "name"      => "粉丝笔记本"
            ],
            [
                "path" => "http://www.fzlu.com/uploads/allimg/121112/1-12111214502KO.jpg" ,
                "token"     => get_token(),
                "name"      => "Jane Eyre"
            ],
            [
                "path" => "http://www.fzlu.com/uploads/allimg/121112/1-12111214505G63.jpg" ,
                "token"     => get_token(),
                "name"      => "诗"
            ],
            [
                "path" => "http://www.fzlu.com/uploads/allimg/121112/1-121112145134U1.jpg" ,
                "token"     => get_token(),
                "name"      => "算术"
            ],
            [
                "path" => "http://img10.360buyimg.com/n1/jfs/t637/343/413516532/165360/151997b5/5466faefN4bba5d4b.jpg" ,
                "token"     => get_token(),
                "name"      => "四大名著"
            ],

        ];
    }
}
