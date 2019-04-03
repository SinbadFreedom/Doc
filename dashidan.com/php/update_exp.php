<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/4/3
 * Time: 16:42
 */

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
$can_edit_time = time() - 60 * 1000;
$query = array(
    "findandmodify" => "col_user",
    "query" => ['openid' => $open_id, 'exp_time' => ['$lt' => $can_edit_time ]],
    "update" =>  ['$inc' => ['exp' => 1]],
    'upsert' => false,
//    'new' => false,
    'fields' => ['exp' => 1]
);
$command = new MongoDB\Driver\Command($query);
$command_cursor = $manager->executeCommand('db_account', $command);
$response = $command_cursor->toArray()[0];
/** 获取新用户id*/
$exp = $response->value->exp;

$res = new stdClass();
//$res->state = 1;
$res->exp = $exp;

json_encode($res);