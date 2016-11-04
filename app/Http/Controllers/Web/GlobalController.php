<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    /**
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

}
