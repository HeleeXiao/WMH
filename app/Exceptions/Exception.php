<?php
namespace App\Exceptions;

/*
 * 扩展错误处理
 */
class Exception  {

    /**
     * @name        Handle
     * @DateTime    ${DATE}
     * @param       $code Int.
     * @return      \Illuminate\Support\Facades\View
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    public static function Handle ($e, $class=false, $function=false){
        switch ($e->getCode()) {
            case 23000:
                /**
                 * TODO LOG
                 */

                /**
                 * 信息回笼
                 */

                return $class && $function
                    ? @config("exception")[$class][$function][$e->getCode()]['message']
                    : "" ;

                break;
            case "42S02":
                /**
                 * LOG
                 */

                /**
                 * 信息回笼
                 */
                return $class && $function
                    ? @config("exception")[$class][$function][$e->getCode()]['message']
                    : "" ;

                break;
        }
    }


}
