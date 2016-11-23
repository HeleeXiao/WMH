<?php

namespace App\Http\Controllers\Web;

use App\Models\Demand;

use App\Models\UserContent;
use Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DemandController extends Controller
{
    const HOME_LIMIT = 12;
    /**
     * 商品详情
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        $demand = Demand::where('id',e($id))->with(["user"=>function($user){
            $user->with(["content"=>function($content){
                $content->with("head");
            }]);
        }, 'tag', "cover", 'discus'=>function($discus){
            $discus->where("state",0)->with(["user"=>function($user){
                $user->with(["content"=>function($content){
                    $content->with("head");
                }]);
            }])->orderBy("id","desc");
        },"file","follow"])->first();
        if( !$demand )
        {
            abort("404",'没有找到该商品');
        }
        \Request::session()->put('url', [
            "intended" => url(\Request::server("REQUEST_URI"))
        ]);
        if(Auth::check())
        {
            Auth::user()->content = UserContent::where("user_id",Auth::user()->id)->with("head")->get();
        }

        return view("web.demand.info",[
            "title"   => $demand->title,
            "demand"  => $demand,
            "demand_id" => $id,
            "media"   => [
                'js'  =>    [
                ],
                'css'  =>    [
                    '/css/lib.6f910717.css',
                    '/css/album-detail.f84edf77.css',
                    '/css/demand-info.css',
                ],
            ]
        ]);
    }

}
