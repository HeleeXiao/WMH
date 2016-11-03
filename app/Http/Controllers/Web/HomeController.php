<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
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
            ],
            'css'  =>    [
                '/css/new_index.css',
            ],
        ];
        return view("web.home",[
            "title" =>  '蒲公英',
            "media" =>  $this->media
        ]);
    }

    /**
     * @name        anyLogin
     * @DateTime:   ${DATE} ${TIME}
     *
     * @param       \Illuminate\Http\Request $request
     *
     * @return      \Illuminate\Support\Facades\View
     *
     * @example
     *
     * @version     1.0
     *
     * @author      < xiaochao@jtrips.com >
     *
     * @copyright   COOL@2016
     */
    public function anyLogin(Request $request)
    {

        if($request->method() == "GET")
        {
            return view("web.login");
        }
        $this->validate($request,[
            "name"  =>  "required",
            "password"  =>  "required"
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
        return back();
    }

    /**
     * @name        getLogout
     * @DateTime:   ${DATE} ${TIME}
     *
     * @return      \Illuminate\Support\Facades\Redirect
     *
     * @example
     *
     * @version     1.0
     *
     * @author      < xiaochao@jtrips.com >
     *
     * @copyright   COOL@2016
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to("/");
    }

    /**
     * @name        getRegister
     * @DateTime:   ${DATE} ${TIME}
     *
     * @param       \Illuminate\Http\Request $request
     *
     * @return      \Illuminate\Support\Facades\View | \Illuminate\Http\Response
     * @return      \Illuminate\Support\Facades\Redirect
     * @return      \Illuminate\Http\Response
     *
     * @example
     *
     * @version     1.0
     *
     * @author      < xiaochao@jtrips.com >
     *
     * @copyright   COOL@2016
     */
    public function getRegister(){
        return view("web.login-register",[
            "title" =>  '注册|登录',
            "media" =>  $this->media
        ]);
    }

    /**
     * @name        postRegister
     * @DateTime:   2016-10-28 19:36:30
     *
     * @param       \Illuminate\Http\Request $request
     *
     * @return      \Illuminate\Support\Facades\Redirect
     *
     * @example
     *
     * @version     1.0
     *
     * @author      < xiaochao@jtrips.com >
     *
     * @copyright   COOL@2016
     */
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            "name"  =>  "required",
            "phone"  =>  "required",
            "password"  =>  "required"
        ]);
        dd($request->all());
    }
}
