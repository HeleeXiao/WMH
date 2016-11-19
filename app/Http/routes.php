<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Blade::setRawTags('{{', '}}');
get("/",function(){
    return redirect("/".config("app.version"));
});
/*
 * 商品
 */
Route::controller("s","Web\\DemandController",[

]);

/*
 * 首页 根路由
 */
Route::controller(substr(config("app.version"),0,strpos(config("app.version"),"/")),"Web\\HomeController");
/*
 * api ajax toJson
 */
Route::controller("api","Web\\GlobalController",[
    "getHomeDataJson"   => "demand.getHomeDataJson",
    "getSubmitDiscus"  => "demand.postSubmitDiscus",
]);

Route::group(['prefix'=>"buddy","namespace"=>"Web"],function(){
    get("/{id}",['uses'=>'UserController@index','middleware' => ['login']]);
});