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
                "path"      => "/images/demand/1-121112145010531.jpg" ,
                "token"     => get_token(),
                "name"      => "粉丝笔记本"
            ],
            [
                "path"      => "/images/demand/1-12111214502KO.jpg" ,
                "token"     => get_token(),
                "name"      => "Jane Eyre"
            ],
            [
                "path"      => "/images/demand/1-12111214505G63.jpg" ,
                "token"     => get_token(),
                "name"      => "诗"
            ],
            [
                "path"      => "/images/demand/1-121112145134U1.jpg" ,
                "token"     => get_token(),
                "name"      => "算术"
            ],
            [
                "path"      => "/images/demand/5466faefN4bba5d4b.jpg" ,
                "token"     => get_token(),
                "name"      => "四大名著"
            ],
            [
                "path"      => "/images/banner/2001.jpg",
                "token"     => get_token(),
                "name"      => "",
                "type"      => 2
            ],
            [
                "path"      => "/images/banner/2002.png",
                "token"     => get_token(),
                "name"      => "",
                "type"      => 2
            ],
            [
                "path"      => "/images/banner/2003.png",
                "token"     => get_token(),
                "name"      => "",
                "type"      => 2
            ],
            [
                "path"      => "/images/banner/2004.jpg",
                "token"     => get_token(),
                "name"      => "",
                "type"      => 2
            ],
            [
                "path"      => "/images/user/default.jpg",
                "token"     => get_token(),
                "name"      => "",
                "type"      => 3
            ],
        ];
    }
}
