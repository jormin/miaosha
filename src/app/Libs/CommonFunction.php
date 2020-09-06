<?php


namespace App\Libs;


class CommonFunction
{

    /*
     * 随机获取字符串
     */
    public static function getRandChar($length, $isStr = true)
    {
        $str = null;
        $strPol = $isStr ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz' : '0123456789';
        $max = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }

    /**
     * 客户端IP
     * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @return mixed
     */
    public static function getClientIP($type = 0)
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) unset($arr[$pos]);
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

    /**
     * 生成订单号
     * @return string
     */
    public static function createOrderId()
    {
        list($usec, $sec) = explode(" ", microtime());
        $usec = substr($usec, 2, 4);
        $rand = mt_rand(1001, 9999);
        return implode(array($sec, $usec, $rand));
    }

}