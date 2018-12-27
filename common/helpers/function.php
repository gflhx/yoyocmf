<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/12
 * Time: 10:07 PM
 */
if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}
if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        return $value;
    }
}
if (!function_exists('p')) {

    function p($var, $die = true)
    {
        echo '<pre>' . print_r($var, true), '</pre>';
        if ($die) {
            die;
        }
    }
}

// 获取随机数
if (!function_exists('getRandNum')) {

    function getRandNum($randStr = "")
    {
        if ($randStr) {
            $num = $randStr . "_" . mt_rand(10000, 99999);
        } else {
            $num = mt_rand(10000, 99999);
        }
        return $num;
    }

}

// 获取返回时间
if (!function_exists('ReturnUtime')) {

    /**
     * 获取时间戳
     * @param string $type 需要获取的时间戳类型：M为月 W为周 D为天
     * @param string $value 需要的值。+ 或者 - 数值。
     * @return array 返回为包含开始时间和结束时间的数组。
     */
    function ReturnUtime($type = '', $value = '')
    {
        $type = strtoupper($type);
        switch ($type) {
            case 'M':
                $t = strtotime((date('Y-m', time()) . '-01 00:00:01')); // 20151031修复strtotime按30天计算的BUG
                $time[] = strtotime(date("Y-m-01 00:00:00", strtotime("{$value} month", $t)));//月开始时间
                $time[] = strtotime(date("Y-m-t 23:59:59", strtotime("{$value} month", $t)));//月结束时间
                break;
            case 'W':
                $time[] = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 + ($value), date('Y'));//周开始时间
                $time[] = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 + ($value), date('Y'));//周结束时间
                break;
            case 'D':
                $time[] = mktime(0, 0, 0, date('m'), date('d') + ($value), date('Y'));//天开始时间
                $time[] = mktime(23, 59, 59, date('m'), date('d') + ($value), date('Y'));//天结束时间
                break;
            case 'Y':
                $time[] = strtotime(date('Y', time()) . '-01-01 00:00:00');//年开始时间
                $time[] = strtotime(date('Y', time()) . '-12-31 23:59:59');//年结束时间
                break;
            default:
                $time[] = mktime(0, 0, 0, date('m'), date('d'), date('Y'));//默认为当天
                $time[] = mktime(23, 59, 59, date('m'), date('d'), date('Y'));//默认为当天
                break;
        }
        return $time;
    }
}

if (!function_exists('esub')) {
    //截取字数
    function esub($string, $length, $dot = '', $rephtml = 0)
    {
        return sub($string, 0, $length, false, $dot, $rephtml);
    }

    //字符截取函数
    function sub($string, $start = 0, $length, $mode = false, $dot = '', $rephtml = 0)
    {
        $strlen = strlen($string);
        if ($strlen <= $length) {
            return $string;
        }

        if ($rephtml == 0) {
            $string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&lt;', '&gt;', '&#039;'), array(' ', '&', '"', '<', '>', "'"), $string);
        }

        $strcut = '';

        $n = $tn = $noc = 0;
        while ($n < $strlen) {

            $t = ord($string[$n]);
            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223) {
                $tn = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t < 239) {
                $tn = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247) {
                $tn = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251) {
                $tn = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253) {
                $tn = 6;
                $n += 6;
                $noc += 2;
            } else {
                $n++;
            }

            if ($noc >= $length) {
                break;
            }

        }
        if ($noc > $length) {
            $n -= $tn;
        }

        $strcut = substr($string, 0, $n);


        if ($rephtml == 0) {
            $strcut = str_replace(array('&', '"', '<', '>', "'"), array('&amp;', '&quot;', '&lt;', '&gt;', '&#039;'), $strcut);
        }

        return $strcut . $dot;
    }
}