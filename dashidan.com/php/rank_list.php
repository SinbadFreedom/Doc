<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 10:02
 */

if (!isset($_GET['openid'])) {
    echo 'param error 1';
    return;
}

if (!isset($_GET['userid'])) {
    echo 'param error 2';
    return;
}

if (!isset($_GET['type'])) {
    echo 'param error 3';
    return;
}

$open_id = $_GET['openid'];
$user_id = $_GET['userid'];
$type = $_GET['type'];

const TYPE_TODAY = 1;
const TYPE_YESTERDAY = 2;
const TYPE_WEEK = 3;
const TYPE_WEEK_LAST = 4;
const TYPE_MONTH = 5;
const TYPE_MONTH_LAST = 6;
const TYPE_ALL = 7;


$time_stamp = time();
$today = date('Y-m-d', $time_stamp);
$file = 'log_rank_list_' . $today . '.log';
$content = 'openid ' . $open_id . ' userid ' . $user_id . ' type ' . $type . " $time_stamp\n";
file_put_contents($file, $content, FILE_APPEND);


/** 获取redis的排行榜数据*/
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$key = null;
switch ($type) {
    case TYPE_TODAY:
        $key = 'rank_today';
        break;
    case TYPE_YESTERDAY:
        $key = 'rank_yesterday';
        break;
    case TYPE_WEEK:
        $key = 'rank_week';
        break;
    case TYPE_WEEK_LAST:
        $key = 'rank_week_last';
        break;
    case TYPE_MONTH:
        $key = 'rank_month';
        break;
    case TYPE_MONTH_LAST:
        $key = 'rank_month_last';
        break;
    case TYPE_ALL:
        $key = 'rank_all';
        break;
}

if ($key) {
    $res = $redis->get($key);
    echo json_encode($res);
} else {
    echo "ERROR, type " . $type;
}