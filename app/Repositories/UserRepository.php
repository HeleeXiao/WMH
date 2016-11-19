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

}