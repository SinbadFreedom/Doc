<?php
/**
 * Created by PhpStorm.
 * User: LiJianhua
 * Date: 2015/9/23
 * Time: 12:00
 */
$url = $_GET['url'];
file_get_contents($url);
$str = "";
for ($i = 0; $i < count($http_response_header); $i++) {
    $str .= $http_response_header[$i];
    if ($i < count($http_response_header) - 1) {
        $str .= "\n";
    }
}
echo $str;


