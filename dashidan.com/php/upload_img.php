<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/28
 * Time: 10:41
 */

echo "----------------------1";
if (isset($_POST['openid'])) {
    $openid = $_POST['openid'];
} else {
    echo "param error 0";
    return;
}
echo "----------------------2";
if (isset($_POST['imgdata'])) {
    $img_data = $_POST['imgdata'];
} else {
    echo "param error 1";
    return;
}

echo "----------------------3";
$decoded_image = base64_decode($img_data);
echo "----------------------4";
$file_name = "../head_img/" . $openid . ".jpg";
$return = file_put_contents($file_name, $decoded_image);
echo "----------------------5";
var_dump($return);
echo "----------------------6";

//getimagesize($file_name);
//$imageInfo = getimagesize($imageName);
//if ($imageInfo !== false) {
//    $imageType = strtolower(substr(image_type_to_extension($imageInfo [2]), 1));
//    $imageSize = filesize($imageInfo);
//    return $info = array('width' => $imageInfo [0], 'height' => $imageInfo [1], 'type' => $imageType, 'size' => $imageSize, 'mine' => $imageInfo ['mine']);
//} else {
//    //不是合法的图片
//    return null;