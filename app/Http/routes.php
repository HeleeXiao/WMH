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
get("/",function(){
    return redirect("/".config("app.version"));
});
Route::controller("s","Web\\DemandController");

Route::controller(config("app.version"),"Web\\HomeController");

Route::controller("api","Web\\GlobalController");

