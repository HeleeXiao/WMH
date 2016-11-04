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
            DB::beginTransaction();
            if (! $data) {
                $data = [
                    'name' => e(\Request::input("name")),
                    'phone' => e(\Request::input("phone")),
                    'password' => e(\Request::input("password")),
                    "state" => 0
                ];
            }

            $user = User::firstOrCreate($data);

            if ($user) {
                if (UserContent::firstOrCreate(['user_id' => $user->id])) {
                    DB::commit();
                    Event::fire(new RegisterEvent($user));
                    return spit( $user );
                }
                DB::rollback();
                return spit( [], 20000 ,'fail' );
            }
            DB::rollback();
            return spit( [], 20000 ,'fail' );

        }catch (\Exception $e){
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