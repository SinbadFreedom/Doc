<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 11:27
 */

$file  = 'log_' . date('Y-m-d', time()) . '.txt';
$content = file_get_contents("php://input");
$content = $content . '\n';
file_put_contents($file, $content, FILE_APPEND);

echo "--------------------------------0";
if (isset($_POST['openid'])) {
    $openid = $_POST['openid'];
} else {
    echo "param error 0";
    return;
}

if (isset($_POST['access_token'])) {
    $access_token = $_POST['access_token'];
} else {
    echo "param error 1";
    return;
}

if (isset($_POST['refresh_token'])) {
    $refresh_token = $_POST['refresh_token'];
} else {
    echo "param error 2";
    return;
}

if (isset($_POST['scope'])) {
    $scope = $_POST['scope'];
} else {
    echo "param error 3";
    return;
}

if (isset($_POST['headimgurl'])) {
    $headimgurl = $_POST['headimgurl'];
} else {
    echo "param error 4";
    return;
}

if (isset($_POST['nickname'])) {
    $nickname = $_POST['nickname'];
} else {
    echo "param error 5";
    return;
}

if (isset($_POST['sex'])) {
    $sex = $_POST['sex'];
} else {
    echo "param error 6";
    return;
}

if (isset($_POST['province'])) {
    $province = $_POST['province'];
} else {
    echo "param error 7";
    return;
}

if (isset($_POST['city'])) {
    $city = $_POST['city'];
} else {
    echo "param error 8";
    return;
}

if (isset($_POST['channel'])) {
    $channel = $_POST['channel'];
} else {
    echo "param error 9";
    return;
}
echo "--------------------------------1";
$user_id = -1;
$mongo_client = new MongoDB\Client();
echo "--------------------------------2";
$database = $mongo_client->account;
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
    $collection = $mongo_client->account->increase;

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
    $collection = $mongo_client->account->users;
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