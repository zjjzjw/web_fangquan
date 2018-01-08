<?php

if (!function_exists('performance')) {

    /**
     * Return Performance
     *
     * @param null $name
     *
     * @return App\Src\Utils\Performance
     */
    function performance($name = null)
    {
        $performance = \App\Src\Utils\Performance::getInstance();
        if (isset($name)) {
            $performance->auto($name);
        }

        return $performance;
    }
}

if (!function_exists('download')) {
    function download($url, $dirName)
    {
        $ch = curl_init();
        $timeout = 30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file = curl_exec($ch);
        curl_close($ch);

        // 获取文件原文件名
        $fileName = basename($url);
        $dirName = public_path($dirName);
        if (!file_exists($dirName)) {
            mkdir($dirName, 0777, true);
        }

        // 保存文件
        $file_path = $dirName . '/' . $fileName;
        $res = fopen($file_path, 'a');
        fwrite($res, $file);
        fclose($res);

        return $file_path;
    }
}

if (!function_exists('time_ago')) {
    function time_ago($agoTime)
    {
        $agoTime = (int)strtotime($agoTime);

        // 计算出当前日期时间到之前的日期时间的毫秒数，以便进行下一步的计算
        $time = time() - $agoTime;

        if ($time >= 31104000) { // N年前
            $num = (int)($time / 31104000);
            return $num . '年前';
        }
        if ($time >= 2592000) { // N月前
            $num = (int)($time / 2592000);
            return $num . '月前';
        }
        if ($time >= 86400) { // N天前
            $num = (int)($time / 86400);
            return $num . '天前';
        }
        if ($time >= 3600) { // N小时前
            $num = (int)($time / 3600);
            return $num . '小时前';
        }
        if ($time > 60) { // N分钟前
            $num = (int)($time / 60);
            return $num . '分钟前';
        }
        return '1分钟前';
    }
}

if (!function_exists('get_file_path')) {
    function get_file_path($file_name)
    {
        return \App\Wap\Http\Controllers\Resource::getFilePath($file_name);
    }
}

