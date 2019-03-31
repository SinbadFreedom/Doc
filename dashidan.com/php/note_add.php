<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/20
 * Time: 1:03
 */
$num = $_POST['num'];
$note = $_POST['note'];
$open_id = $_POST['openid'];
$user_id = $_POST['userid'];
$nick_name = $_POST['name'];

$time = time();

if (!is_numeric($num)) {
    echo 'param error 0';
    return;
}

if (!$note) {
    echo 'param error 1';
    return;
}

if (!$open_id) {
    echo 'param error 2';
    return;
}

if (!$user_id) {
    echo 'param error 3';
    return;
}

if (!$nick_name) {
    echo 'param error 4';
    return;
}

/** collection name*/
$db_collection_name = 'python3.note_' . $num;

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['num' => $num, 'note' => $note, 'openid' => $open_id, 'userid' => $user_id, 'name' => $nick_name, 'time' => $time]);

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);//可选，修改确认
$res = $manager->executeBulkWrite($db_collection_name, $bulk, $writeConcern);