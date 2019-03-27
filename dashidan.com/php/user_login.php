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
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
echo "--------------------------------2";
$filter =  ['openid'=>$openid];
$query = new MongoDB\Driver\Query($filter);
$options = array(
    'limit' => 1
);
echo "--------------------------------3";
$user = $manager->executeQuery('account.user', $query, $options);
echo "--------------------------------4";
var_dump($user);

if ($user) {
    /** 老用户*/
    echo "--------------------------------5";
    $user_id = $user['user_id'];
} else {
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);//可选，修改确认

    $bulkIncreaseId = new MongoDB\Driver\BulkWrite();
    /** 新用户*/
    echo "--------------------------------6";
    $user_id = $bulkIncreaseId->update(
        ['table' => 'inc_user_id'],
        ['$inc' => ['user_id_now' => 1]],
        [
            'upsert' => true,
            'projection' => ['user_id_now' => 1],
            'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER,
        ]
    );
    var_dump($user_id);
    echo "--------------------------------7";
    $increaseIdResult = $manager->executeBulkWrite('account.increase', $bulkIncreaseId, $writeConcern);
    var_dump($increaseIdResult);
    echo "--------------------------------8";
    $bulkInsertUser = new MongoDB\Driver\BulkWrite();
    $bulkInsertUser->insert([
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
    /** 插入数据库*/
    $insertOneResult = $manager->executeBulkWrite('account.user', $bulkInsertUser, $writeConcern);
    var_dump($insertOneResult);
    echo "--------------------------------9";
}

echo "--------------------------------10";
$res = new stdClass;
$res['user_id'] = $user_id;

var_dump(json_encode($res));