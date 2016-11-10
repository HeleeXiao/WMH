<?php

use Illuminate\Database\Seeder;

class DemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(" create Demands loading ... ");
        for($i = 0 ; $i < 21; $i++){
            foreach ($this->default_() as $value) {
                \App\Models\Demand::firstOrCreate($value);
            }
        }
    }

    public function default_(){
        $user = \App\Models\User::where("state",0)->get()->pluck("id")->toArray();
        return [
            [
                "name"    =>  "粉红日记本",
                "title"    =>  "粉红日记本，只换不卖",
                "description"    =>  "2003老记事本，姐姐那年送我的12岁生日礼物，这本日记本对我来说有很大的意义，不过
                                    我愿意拿出来分享，此物非卖品，愿寻得中意物品一换",
                "token"     => get_token(),
                "file_id"   => 1,
                "user_id"   => array_rand( $user )
            ],
            [
                "name"    =>  "简·爱",
                "title"    =>  "很久以前的一本简·爱 ，没有定价。你感动我 ，我送给你",
                "description"    =>  "女主人公，一个性格坚强，朴实，刚柔并济，独立自主，积极进取的女性。
                                    她出身卑微，相貌平凡，但她并不以此自卑。她蔑视权贵的骄横，嘲笑他们的愚笨，
                                    显示出自立自强的人格和美好的理想。她有顽强的生命力，从不向命运低头，
                                    最后有了自己所向往的美好生活。简·爱生存在一个父母双亡，寄人篱下的环境。
                                    从小就承受着与同龄人不一样的待遇：姨妈的嫌弃，表姐的蔑视，表哥的侮辱和毒打。
                                    但她并没有绝望，她并没有自我摧毁，并没有在侮辱中沉沦....",
                "token"     => get_token(),
                "file_id"   => 2,
                "user_id"   => array_rand( $user )
            ],
            [
                "name"    =>  "诗",
                "title"    =>  "一本诗集，15元出售吧",
                "description"    =>  "她蔑视权贵的骄横，嘲笑他们的愚笨，
                                    显示出自立自强的人格和美好的理想。她有顽强的生命力，从不向命运低头，
                                    最后有了自己所向往的美好生活。简·爱生存在一个父母双亡，寄人篱下的环境。
                                    从小就承受着与同龄人不一样的待遇：姨妈的嫌弃，表姐的蔑视，表哥的侮辱和毒打。
                                    但她并没有绝望，她并没有自我摧毁",
                "token"     => get_token(),
                "file_id"   => 3,
                "user_id"   => array_rand( $user )
            ],
            [
                "name"    =>  "算数",
                "title"    =>  "多年前的唯美算数笔记，拿东西来换吧",
                "description"    =>  "这样一个数列 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233，377，610，987，1597，2584，4181，6765，10946，17711，28657，46368........
                                    自然中的斐波那契数列
                                    自然中的斐波那契数列
                                    这个数列从第3项开始，每一项都等于前两项之和。",
                "token"     => get_token(),
                "file_id"   => 4,
                "user_id"   => array_rand( $user )
            ],
            [
                "name"    =>  "四大名著",
                "title"    =>  "民国时期的四大名著",
                "description"    =>  "中国古典长篇小说四大名著，简称四大名著，是指《红楼梦》、《三国演义》、《水浒传》、《西游记》
                                        这四部巨著。四大名著是中国文学史中的经典作品，是世界宝贵的文化遗产。",
                "token"     => get_token(),
                "file_id"   => 5,
                "user_id"   => array_rand( $user )
            ],
        ];
    }
}
