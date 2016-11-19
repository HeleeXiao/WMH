<?php

namespace App\Http\Controllers\Web;

use App\Models\Demand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class GlobalController extends Controller
{

    public function __construct(Request $request)
    {
        if( $request->ajax() === false )
        {
            return response()->json(spit([],"10400","非法的请求方式"));
        }
    }

    /**
     * 获取二维码
     * @name        getCaptchaSrc
     * @DateTime    ${DATE}
     * @param       .
     * @return      Json
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getCaptcha()
    {
        return response()->json(spit([
            "src"   => captcha_src(),
            "img"   => captcha_img(),
        ]));
    }

    /**
     * ajax 获取首页瀑布流数据
     * @name        getHomeDataJson
     * @DateTime    2016-11-19
     * @param       \Illuminate\Http\Request.
     * @return      Response
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getHomeDataJson(Request $request)
    {
        $page = $request->has("page") ? $request->input("page") : 2;
        return response()->json( Demand::where('state', 0)->where("status", 0)
            ->with(["user", "cover","discus"])
            ->skip(DemandController::HOME_LIMIT * ($page - 1 ))
            ->take(DemandController::HOME_LIMIT)
            ->orderBy("id","asc")
            ->get()->toArray(false) );
    }



    /**
     * 提交商品评论
     * @name        postSubmitDiscus
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function getSubmitDiscus(Request $request)
    {
        /*
         * TODO 查询评论用户类型 0 游客，1 交易者
         */

        $valiDataFiled = ["discus","user_id","demand_id"];

        foreach ($valiDataFiled as $value) {
            if(! $request->input($value) )
            {
                return response()->json(spit([],10103,"缺失必要参数 ".$value));
            }
        }

        $discus = \App\Models\Discus::firstOrCreate([
            'content'   => e($request->input("discus")),
            "user_id"   => e($request->input("user_id")),
            "demand_id" => e($request->input("demand_id")),
            "type"      => 0
        ]);
        return response()->json(spit($discus));
    }

}
