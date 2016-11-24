<?php

namespace App\Http\Controllers\Web;


use App\Exceptions\Exception as appException;

use App\Models\Demand;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Events\LoginEvent;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Psy\VarDumper\Presenter;
use TomLingham\Searchy\Facades\Searchy;

class HomeController extends Controller
{
    private $media;
    const HOME_LIMIT = 12;
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
                '/layer/skin/layui.css',
                '/css/new_index.css',
            ],
        ];

        //TODO getRecommendedContent
        try {
            $demands = Demand::where('state', 0)->where("status", 0)
                ->with(["user", "cover","discus"])->paginate( self::HOME_LIMIT );

            return view("web.home", [
                "title" => '首页',
                "media" => $this->media,
                "demands" => $demands,
                "banner" => \App\Models\File::where("type", 2)->where("state", 0)->get()
            ]);
        }catch (\Exception $e){
            return view("web.login-register")->with("pageMsg",$e->getMessage())->with("level","fail");
        }
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
            if(Auth::check()){
                return Redirect::intended("/");
            }
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
            /*
             * 激活登录事件  记录登录次数
             */
            Event::fire( new LoginEvent( Auth::user() ) );
            $request->session()->put("buddy.head",User::where("id",Auth::id())
                ->with(["content"=>function($content){
                    $content->with("head");
                }])
                ->first()->content->head->path);
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
    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->forget("buddy");
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
        if(Auth::check()){
            return Redirect::intended("/");
        }
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

//        try {
            $this->validate($request,[
                "name"      =>  "required|unique:users",    // |unique:users 表示 检查users表是否存在此数据
                "phone"     =>  "required|unique:users",    // |unique:users 表示 检查users表是否存在此数据
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
//        }catch (\Exception $e) {
//            dd($e);
//            return spit( [],500,appException::Handle( $e, UserRepository::class, "register" ) );
//        }
        $spit = UserRepository::register();
        if( $spit['status'] == 200 )//调用注册类
        {
            Auth::loginUsingId($spit['result']->id);
            if( ! $request->session()->has("buddy.head") )
            {

                $request->session()->put("buddy.head",User::where("id",$spit['result']->id)
                    ->with(["content"=>function($content){
                        $content->with("head");
                    }])
                    ->first()->content->head->path);
            }
            return Redirect::intended("/");
        }
        return back()->with("pageMsg","注册失败")->with("level","fail");
    }

    /**
     * @name        getSearch
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getSearch(Request $request)
    {
        $searchUsers =  Searchy::users("name","email")->query(e($request->input("q")))
            ->getQuery()->having("state","=",0)->get();
        $pagedata = collect( $searchUsers )->toArray();
        $pagesize=10;
        $pageout=array_slice($pagedata, (e($request->input('page'))-1)*$pagesize,$pagesize);
        $paginator = new Paginator($pagedata,$pagesize);
        dump($paginator);
    }

    /**
     * @name        getNavigation
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getNavigation()
    {
        return view("web.newest",[
            "title" => "给心灵一片净土",
        ]);
    }
}
