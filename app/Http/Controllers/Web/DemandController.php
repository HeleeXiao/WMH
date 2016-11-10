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
        dd(Demand::where('id',e($id))->with(["user", 'tag', "file", 'discus'])->get()->toArray());
    }


}
