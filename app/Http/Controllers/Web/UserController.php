<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    private $IS_ME = false;
    /**
     * Display a listing of the resource.
     *
     * @return \View
     */
    public function index($user_id=false, Request $request)
    {
        if( !$user_id && !Auth::check())
        {
            abort(404,"没有用户依据");
        }
        if( !$user_id || ( $user_id && e($user_id) == Auth::id() ) )
        {
            $this->IS_ME = true;
            $user_id = Auth::id();
        }
        if(!User::find($user_id))
        {
            abort(404,"没有该用户信息");
        }
        $buddy = UserRepository::getBuddyInfo($user_id);
        $tab = UserRepository::getTabData($user_id);
        return view("web.buddy.index",[
            "title" =>  $buddy->name . ' | 个人主页',
            "buddy" =>  $buddy,
            "IS_ME" =>  $this->IS_ME,
            "tab"   =>  $tab,
            "authFollowBuddy" => collect( array_where( Auth::user()->follow->toArray(),
                                function($key,$value){
                                    return $value['cover_user_id'] > 0 && $value['state'] == 0;
                                } ) )->pluck("cover_user_id")->toArray(),
            "media"   => [
                'js'  =>    [],
                'css' =>    [
                    '/css/buddy.css',
                    '/css/image/lrtk.css',
                    '/css/new_index.css',
                ],
            ]
        ]);
    }

    /**
     * @name        edit
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function edit()
    {
        return ;
    }

}
