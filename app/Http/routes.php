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

Route::controller("s","Web\\DemandController");

Route::controller(substr(config("app.version"),0,strpos(config("app.version"),"/")),"Web\\HomeController");

Route::controller("api","Web\\GlobalController");

Route::group(['prefix'=>"buddy","namespace"=>"Web"],function(){
    get("/{id}",['uses'=>'UserController@index','middleware' => ['login']]);
});