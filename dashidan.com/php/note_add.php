<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/20
 * Time: 1:03
 */
$num = $_POST['num'];
$note = $_POST['note'];

//TODO check num is number format

if (!$num || !$note) {
    echo 'param error';
    return;
}

/** collection name*/
$db_collection_name = 'python3.note_' . $num;

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert(['num' => $num, 'note' => $note]);

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 3000);//可选，修改确认
$res = $manager->executeBulkWrite($db_collection_name, $bulk, $writeConcern);
//echo '<pre>';
//print_r($res);
