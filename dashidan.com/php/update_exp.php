<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/4/3
 * Time: 16:42
 */

$file = 'log_update_exp_' . date('Y-m-d', time()) . '.txt';
$content = file_get_contents("php://input");
$content = $content . "\n";
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
$can_edit_time = time() - 60;
$query = array(
    "findandmodify" => "col_user",
    "query" => ['openid' => $open_id, 'exp_time' => ['$lt' => $can_edit_time]],
    "update" => ['$inc' => ['exp' => 1], 'exp_time' => time()],
    'upsert' => false,
//    'new' => false,
    'fields' => ['exp' => 1]
);

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$command = new MongoDB\Driver\Command($query);
$command_cursor = $manager->executeCommand('db_account', $command);
$response = $command_cursor->toArray()[0];
echo '-----------------1';
var_dump($response);
echo '-----------------2';
/** 获取新用户id*/
$res = new stdClass();
if ($response->value) {
    $res->state = 0;
    $exp = $response->value->exp;
    $res->exp = $exp;
} else {
    $res->state = -1;
}
echo '-----------------3';
//$res->state = 1;
//var_dump($res);
echo json_encode($res);