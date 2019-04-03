<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 11:27
 */

$file = 'log_user_login_' . date('Y-m-d', time()) . '.txt';
$content = file_get_contents("php://input");
$content = $content . "\n";
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
$exp = 1;
$is_new = false;
/** 根据openid 查找用户数据*/
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = ['openid' => $openid];
$options = array(
    'limit' => 1
);
$query_find = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('db_account.col_user', $query_find);
$user_info = $cursor->toArray()[0];
/** 区分新老用户*/
if ($user_info) {
    /** 老用户*/
    $user_id = $user_info->user_id;
    $exp = $user_info->exp;
} else {
    /** 新用户*/
    $is_new = true;
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);
    /** 生成自增id*/
    $query = array(
        "findandmodify" => "col_increase",
        "query" => ['table' => 'inc_user_id'],
        "update" =>  ['$inc' => ['user_id_now' => 1]],
        'upsert' => true,
//        'new' => true,
        'fields' => ['user_id_now' => 1]
    );
    $command = new MongoDB\Driver\Command($query);
    $command_cursor = $manager->executeCommand('db_account', $command);
    $response = $command_cursor->toArray()[0];
    /** 获取新用户id*/
    $user_id = $response->value->user_id_now;
    /** 插入用户表*/
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
        'exp' => $exp,
        'exp_time' => time(),
        'create_time' => time()
    ]);
    /** 插入数据库*/
    $insertOneResult = $manager->executeBulkWrite('db_account.col_user', $bulkInsertUser, $writeConcern);
}
/** 返回用户id*/
$res = new stdClass;
$res->user_id = $user_id;
$res->is_new = $is_new;
$res->exp = $exp;

echo json_encode($res);