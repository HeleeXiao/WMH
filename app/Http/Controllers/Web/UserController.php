<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    private $IS_ME = false;

    public function __construct()
    {
        $this->middleware("login");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        if( !$request->has("u") && !Auth::check()){
            abort(404,"没有找到该用户");
        }
        if( !$request->has("u") || ( $request->has("u") && e($request->input("u")) == Auth::user()->id ) )
        {
            $this->IS_ME = true;
            $user = Auth::user();
        }else{
            $user = User::find(e($request->input("u")));
        }
        dd($user);
    }

}
