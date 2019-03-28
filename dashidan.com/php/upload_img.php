<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/28
 * Time: 10:41
 */

if (isset($_POST['openid'])) {
    $openid = $_POST['openid'];
} else {
    echo "param error 0";
    return;
}
if (isset($_POST['imgdata'])) {
    $img_data = $_POST['imgdata'];
} else {
    echo "param error 1";
    return;
}

$decoded_image = base64_decode($img_data);
/** 需要提前创建好 上级 head_img目录，并且设置目录权限 777 */
$file_name = "../head_img/" . $openid . ".jpg";
$return = file_put_contents($file_name, $decoded_image);

var_dump($return);