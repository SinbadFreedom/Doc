<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/15
 * Time: 12:20
 */

$num = $_GET['num'];
//TODO check num is number format
if (!$num) {
    return;
}

/** collection name*/;
$db_collection_name = 'python3.note_' . $num;

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$query = new MongoDB\Driver\Query(['num' => $num]);
$cursor = $manager->executeQuery($db_collection_name, $query);

$data = [];
foreach ($cursor as $doc) {
    array_push($data, $doc);
}

//TODO 笔记数据分页
if (sizeof($data) > 0) {
    echo json_encode($data);
} else {
    echo "";
}
