<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 11:27
 */

$file = 'log_' . date('Y-m-d', time()) . '.txt';
$content = file_get_contents("php://input");
$content = $content . '\n';
file_put_contents($file, $content, FILE_APPEND);

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
$user_id = -1;
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = ['openid' => $openid];
$options = array(
    'limit' => 1
);
$query_find = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('db_account.col_user', $query_find);
echo "--------------------------------4";
$user_info = $cursor->toArray()[0];
//var_dump($cursor);
//echo "--------------------------------4+";
//$iterator = new IteratorIterator($cursor);
//$user_info = $iterator->current();
echo "--------------------------------4++";
var_dump($user_info);
echo "--------------------------------4+++";
if ($user_info) {
    /** 老用户*/
    $user_id = $user_info->user_id;
    echo "--------------------------------5";
} else {
    /** 新用户*/
    echo "--------------------------------6";
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);//可选，修改确认
    $query = array(
        "findandmodify" => "col_increase",
        "query" => ['table' => 'inc_user_id'],
        "update" =>  ['$inc' => ['user_id_now' => 1]],
        'upsert' => true,
        'new' => true,
        'fields' => ['user_id_now' => 1]
    );
    echo "--------------------------------6+";
    $command = new MongoDB\Driver\Command($query);
    echo "--------------------------------7";
    $command_cursor = $manager->executeCommand('db_account', $command);
    $response = $command_cursor->toArray()[0];
    var_dump($response);
    echo "--------------------------------8";
    $user_id = $response->value->user_id_now;
    echo "--------------------------------8+";
    echo "--------------------------------8++".$user_id;
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
    echo "--------------------------------9";
    /** 插入数据库*/
    $insertOneResult = $manager->executeBulkWrite('db_account.col_user', $bulkInsertUser, $writeConcern);
    var_dump($insertOneResult);
    echo "--------------------------------10";
}

echo "--------------------------------11";
$res = new stdClass;
$res->user_id = $user_id;

var_dump(json_encode($res));