<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 11:27
 */

$openid = $_POST['openid'];
$access_token = $_POST['access_token'];
$refresh_token = $_POST['refresh_token'];
$scope = $_POST['scope'];

$headimgurl = $_POST['headimgurl'];
$nickname = $_POST['nickname'];
$sex = $_POST['sex'];
$province = $_POST['province'];
$city = $_POST['city'];

$channel = $_POST['channel'];

echo "--------------------------------1";


if (!$openid || !$access_token || $refresh_token || $scope || $headimgurl || $nickname || $sex || $province || $city || $channel) {
    echo 'param error';
    return;
}

echo "--------------------------------2";

$user_id = -1;
$database = (new MongoDB\Client)->account;
echo "--------------------------------3";
$user = $database->user->findOne(['openid' => $openid]);
echo "--------------------------------4";
var_dump($user);

if ($user) {
    /** 老用户*/
    var_dump($user);
    echo "--------------------------------5";
    $user_id = $user['user_id'];
} else {
    /** 新用户*/
    echo "--------------------------------6";
    $collection = (new MongoDB\Client)->account->increase;

    $user_id = $collection->findOneAndUpdate(
        ['table' => 'inc_user_id'],
        ['$inc' => ['user_id_now' => 1]],
        [
            'upsert' => true,
            'projection' => ['user_id_now' => 1],
            'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER,
        ]
    );
    echo "--------------------------------7";
    var_dump($user_id);
    /** 插入数据库*/
    $collection = (new MongoDB\Client)->account->users;
    $insertOneResult = $collection->insertOne([
        'openid' => $openid,
        'access_token' => $access_token,
        'refresh_token' => $refresh_token,
        'scope' => $scope,

        'headimgurl' => $headimgurl,
        'nickname' => $nickname,
        'sex' => $sex,
        'province' => $province,
        'city' => $city,

        'channel' => $channel,
        'user_id' => $user_id,
    ]);

    echo "--------------------------------8";
    var_dump($insertOneResult);
}
echo "--------------------------------9";

$res = new stdClass;
$res['user_id'] = $user_id;

var_dump(json_encode($res));



//$restaurant = $database->restaurants->findOne([
//    '_id' => new MongoDB\BSON\ObjectId('594d5ef280a846852a4b3f70'),
//]);