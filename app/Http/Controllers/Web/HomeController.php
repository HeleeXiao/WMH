<?php

namespace App\Http\Controllers\Web;

use App\Models\Demand;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    private $media;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $this->media = [
            'js'  =>    [
                '/layer/layui.js',
            ],
            'css'  =>    [
                '/css/new_index.css',
                '/layer/skin/layui.css',
            ],
        ];

        return view("web.home",[
            "title" =>  '首页',
            "media" =>  $this->media
        ]);
    }

    /**
     * @name        anyLogin
     * @DateTime   ${DATE} ${TIME}
     * @param       \Illuminate\Http\Request $request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function anyLogin(Request $request)
    {

        if($request->method() == "GET")
        {
            return view("web.login-register",[
                "page"  =>  "login",
            ]);
        }
        $this->validate($request,[
            "name"  =>  "required",
            "password"  =>  "required"
        ],[
            "name.required"     =>"请务必填写名称",
            "password.required" =>"请务必填写密码",
        ]);

        /*
         * POST data
         */
        if( Auth::attempt(['name' => e($request->input("name")), 'password' => e($request->input("password"))])
            || Auth::attempt(['email' => e($request->input("name")), 'password' => e($request->input("password"))])
            || Auth::attempt(['phone' => e($request->input("name")), 'password' => e($request->input("password"))])
        )
        {
            return Redirect::intended("/");
        }
        $validator = Validator::make($request->all(), []);
        $validator->errors()->add("name","账号或密码错误");
        $validator->errors()->add("password","账号或密码错误");
        return back()->withErrors($validator)->withInput();
    }

    /**
     * @name        getLogout
     * @DateTime   ${DATE} ${TIME}
     * @param       \Illuminate\Http\Request $request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to("/");
    }

    /***
     * @name        getRegister
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getRegister(){
        return view("web.login-register",[
            "title" =>  '注册|登录',
            "page"  =>  "register",
            "media" =>  $this->media
        ]);
    }

    /**
     * @name        postRegister
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            "name"      =>  "required|unique:users",
            "phone"     =>  "required|unique:users",
            "captcha"   =>  "required",
            "password"  =>  "required"
        ],[
            "name.required"     =>"请务必填写名称",
            "password.required" =>"请务必填写密码",
            "phone.required"    =>"请务必填写手机号",
            "name.unique"       =>"该名称已经被使用",
            "phone.unique"      =>"该号码已经被使用",
            "captcha.required"  =>"请务必填写验证码",
        ]);


        if( UserRepository::register()['status'] == 200 )
        {
            return redirect("/");
        }
        return back()->with("pageMsg","注册失败")->with("level","fail");
    }
}
