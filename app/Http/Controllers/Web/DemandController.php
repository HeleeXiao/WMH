<?php

namespace App\Http\Controllers\Web;

use App\Models\Demand;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DemandController extends Controller
{
    /**
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
        }, 'tag', "cover", 'discus',"file","follow"])->first();
        if( !$demand )
        {
            abort("404",'没有找到该商品');
        }
        \Request::session()->put('url', [
            "intended" => url(\Request::server("REQUEST_URI"))
        ]);

        return view("web.demand.info",[
            "title"   => $demand->title,
            "demand"  => $demand,
            "media"   => [
                'js'  =>    [
                ],
                'css'  =>    [
                    '/css/lib.6f910717.css',
                    '/css/album-detail.f84edf77.css',
                    "new_index.css"
                ],
            ]
        ]);
    }


}
