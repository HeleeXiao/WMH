<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    /**
     * @name        response
     * @DateTime    ${DATE}
     * @param       .
     * @return      array.
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    protected static function response($data=[], $status = 200, $message = "success")
    {
        return [
            "status"    => $status,
            "message"   => $message,
            "result"    =>  $data,
        ];
    }

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
        return response()->json(self::response([
            "src"   => captcha_src(),
            "img"   => captcha_img(),
        ]));
    }

}
