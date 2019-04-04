<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/4/3
 * Time: 16:42
 */
$time_stamp = time();
$file = 'log_update_exp_' . date('Y-m-d', $time_stamp) . '.txt';
$content = file_get_contents("php://input");
$content = $content . " $time_stamp\n";
file_put_contents($file, $content, FILE_APPEND);

$open_id = $_POST['openid'];
$user_id = $_POST['userid'];

if (!$open_id) {
    echo 'param error 1';
    return;
}

if (!$user_id) {
    echo 'param error 2';
    return;
}

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);
/** 生成自增id*/
/** 有效更新时间，间隔至少1分钟*/
$can_edit_time = $time_stamp - 60;
$query = array(
    "findandmodify" => "col_user",
    "query" => ['openid' => $open_id, 'exp_time' => ['$lt' => $can_edit_time]],
    "update" => ['$inc' => ['exp' => 1], '$set' => ['exp_time' => $time_stamp]],
    'upsert' => false,
    'new' => true,
    'fields' => ['exp' => 1]
);

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$command = new MongoDB\Driver\Command($query);
$command_cursor = $manager->executeCommand('db_account', $command);
$response = $command_cursor->toArray()[0];
/** 获取新用户id*/
$res = new stdClass();
if ($response->value) {
    $res->state = 0;
    $exp = $response->value->exp;
    $res->exp = $exp;
} else {
    $res->state = -1;
}
echo json_encode($res);