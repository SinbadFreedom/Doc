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

$db_name = 'python3';

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$query = new MongoDB\Driver\Query(['num' => $num]);
$cursor = $manager->executeQuery($db_name, $query);

$data = [];
foreach($cursor as $doc) {
    $data[] = $doc;
}

print_r($data);

$info = $data[0];

echo json_encode($info);