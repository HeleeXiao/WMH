<?php

namespace App\Http\Controllers\Web;

use App\Models\Demand;
use App\Models\Follow;
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
     * 获取验证码
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

    /**
     * 提交关注、收藏
     * @name        postFollow
     * @DateTime    ${DATE}
     * @param       \Illuminate\Http\Request.
     * @return      \Response
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public function anyFollow(Request $request)
    {
        $valiDataFiled = ["user_id","field",'value'];

        foreach ($valiDataFiled as $value) {
            if(! $request->input($value) )
            {
                return response()->json(spit([],10103,"缺失必要参数 ".$value));
            }
        }

        $ins = [
            'user_id' => e($request->input("user_id")),
            e($request->input("field")).'_id' => e($request->input("value"))
        ];
        $paFollow = Follow::where($ins)->first();

        $state = 0;
        $message = $request->input("field") == "demand" ? '收藏' : '关注' ;
        if(count( $paFollow ) ){

            if($paFollow->state == 0)
            {
                $state = 1;
            }
            if( Follow::where($ins)->update(['state'=>$state]) )
            {
                return response()->json(spit(['state'=>$state],200,!$state ? '已'.$message:"已取消".$message));
            }
        }
        if( Follow::create($ins) )
        {
            return response()->json(spit(['state'=>$state],200,'已'.$message));
        }

        return response()->json(spit([],500,'操作失败'));

    }

}
