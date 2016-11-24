<?php
namespace App\Repositories;


use App\Events\RegisterEvent;
use App\Models\User;
use App\Models\UserContent;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Exception as appException;
use Illuminate\Support\Facades\Event;

class UserRepository{

    /**
     * @name        regsiter
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request. | data Array
     * @return      Array
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public static function register($data = null)
    {
        try {
            //开启事务
            DB::beginTransaction();
            /*
             * 判断获取参数
             */
            if (! $data) {
                $data = [
                    'name' => e(\Request::input("name")),
                    'phone' => e(\Request::input("phone")),
                    'password' => e(\Request::input("password")),
                    "state" => 0
                ];
            }

            /*
             * 用户基本信息 。有则获取，无则新增
             */
            $user = User::firstOrCreate($data);

            if ($user) {

                $files = \App\Models\File::where("state",0)->get()->pluck("id");
                /*
                 * 创建用户详细信息
                 */
                if (UserContent::firstOrCreate([
                    'user_id' => $user->id,
                    'file_id' => $files[array_rand($files->toArray())]
                ])) {
                    DB::commit();
                    /*
                     * 侦测注册事件，激活发送信息事件
                     */
                    Event::fire(new RegisterEvent($user));
                    return spit( $user );
                }
                DB::rollback();
                return spit( [], 20000 ,'fail' );
            }
            DB::rollback();
            return spit( [], 20000 ,'fail' );

        }catch (\Exception $e){
            /*
             * 错误处理
             */
            DB::rollback();
//            return spit( [],500,appException::Handle( $e, __class__, __function__ ) );
            return spit( [],500,$e->getMessage() );
        }

    }

    /**
     * @name        delete
     * @DateTime    ${DATE}
     * @param       user_id Int
     * @return      Array
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public static function delete()
    {

    }

    /**
     * @name        getTabData
     * @DateTime    2016-11-21
     * @param       \Illuminate\Http\Request.
     * @return      Array
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public static function getTabData($user_id)
    {
        $tab = [
            [
                "title" => "历史",
                "data"=>[],
                "active"=>true,
                "name"=>"browses",
                "icon" => "&#xe60e;",
            ],
            [
                "title" => "关注",
                "data"=>[],
                "active"=>false,
                "name"=>"follow_user",
                "icon" => "&#xe618;",
            ],
            [
                "title" => "粉丝",
                "data"=>[],
                "active"=>false,
                "name"=>"fans",
                "icon" => "&#xe650;",
            ]
        ];
        if( auth()->id() == $user_id )
        {
            $tab[] = [
                "title" => "收藏",
                "data"=>[],
                "active"=>false,
                "name"=>"follow_demand",
                "icon" => "&#xe629;",
            ];
            $tab[] = [
                "title" => "交易",
                "data"=>[],
                "active"=>false,
                "name" => 'trade',
                "icon" => "&#xe64c;",
            ];
            $tab[] = [
                "title" => "消息",
                "data"=>[],
                "active"=>false,
                "name" => 'message',
                "icon" => "&#xe63a;",
            ];
            $tab[] = [
                "title" => "资料",
                "data"=>[],
                "active"=>false,
                "name" => 'data',
                "icon" => "&#xe63a;",
            ];
            $tab[] = [
                "title" => "设置",
                "data"=>[],
                "active"=>false,
                "name" => 'set',
                "icon" => "&#xe620;",
            ];
        }
        return $tab;
    }

    public static function getBuddyInfo($user_id)
    {
        if(!$user_id)
        {
            return [];
        }
        return User::where("id",$user_id)->with(["content"=>function($content){
            $content->with("head");
        }])->with([
            "follow"=>function($follow){
                $follow->with(["idol"=>function($idol){
                    $idol->with(['content'=>function($content){
                        $content->with('head');
                    }]);
                },"demand"])->where("state",0);
            },'fans'=>function($fans){
                $fans->with(["user"=>function($user){
                    $user->with(['content'=>function($content){
                        $content->with('head');
                    }]);
                }]);
            },'browse'=>function($browse){
                $browse->where('demand_id','>',0)
                    ->orderBy('created_at',"desc")
                    ->groupBy("demand_id")
                    ->with("demand");
            }
        ])->first();
    }

}