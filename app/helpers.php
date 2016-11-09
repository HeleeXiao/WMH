<?php
/**
 * 公共函数库
 */

if (! function_exists('unique_code')) {
    /**
     * 唯一编号
     * @return string
     */
    function get_token()
    {
        return sha1( date('YmdHis') . mt_rand(100000, 999999) );
    }
}

if (! function_exists('getUpdateInfo')) {
    /**
     * Filter columns that need to be updated.
     *
     * @param object $request
     * @param array $columns
     * @return null|array
     */
    function getUpdateInfo($request, $columns)
    {
        $response = null;
        foreach ($columns as $key => $val) {
            //if ($request->input($val)) {
                $response[$val] = $request->input($val);
            //}
        }
        return $response;
    }
}

if (! function_exists('escape_like')) {
    /**
     * @param $string
     * @return mixed
     */
    function escape_like($string)
    {
        $search = array('%','_','、');
        $replace = array('\%', '\_','\、');
        return str_replace($search, $replace, $string);
    }
}

if (! function_exists('spit')) {
    /**
     * @name        spit
     * @DateTime    ${DATE}
     * @param       .$data      array
     * @param       .$status    int
     * @param       .$message   string
     * @return      array.
     * @version     1.0
     * @author      < 18681032630@163.com >
     */
    function spit($data=[], $status = 200, $message = "success")
    {
        return [
            "status"    => $status,
            "message"   => $message,
            "result"    =>  $data,
        ];
    }

}