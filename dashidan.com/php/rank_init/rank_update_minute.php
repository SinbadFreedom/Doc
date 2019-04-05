<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/4/4
 * Time: 16:50
 */

/** 获取redis的排行榜数据*/
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
/** 日期相关的key与mongodb表对应*/
$time_stamp = time();
$today = date('Y-m-d', $time_stamp);
$yesterday = date('Y-m-d', $time_stamp - 24 * 60 * 60);
$year = date('Y', $time_stamp);
$month = date('m', $time_stamp);
/** 从1970年1月1日以来的总周数，方便计算上一周排名, 1970年1月1日是周四，减去4天的时间差，从19700105日，周一的时间差开始算总周数*/
$week = intval(($time_stamp - 4 * 24 * 60 * 60) / (7 * 24 * 60 * 60));
/** 日,周，月，经验数据表名*/
$col_today = "col_day_" . $today;
$col_yesterday = "col_day_" . $yesterday;
$col_week = "col_week_" . $week;
$col_week_last = "col_week_" . ($week - 1);
$col_month = "col_month_" . $year . "_" . $month;
if ($month > 1) {
    $col_month_last = "col_month_" . $year . "_" . $month;
} else {
    $col_month_last = "col_month_" . ($year - 1) . "_" . 12;
}
$col_all = "col_all";

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

/** 获取对用排行榜数据,前100名 每分钟定时更新 今日，本周，本月，全部*/
/** ['val0' => 0, 'val2' => 2, 'val10' => 10] */
$res_1 = $redis->zRange($col_today, 0, 99, true);
var_dump($res_1);
getUserInfo($res_1, $manager);
var_dump($res_1);

$redis->set("rank_today", json_encode($res_1));
$res_3 = $redis->zRange($col_week, 0, 99, true);
getUserInfo($res_3, $manager);
$redis->set("rank_week", json_encode($res_3));
$res_5 = $redis->zRange($col_month, 0, 99, true);
getUserInfo($res_5, $manager);
$redis->set("rank_month", json_encode($res_5));
$res_7 = $redis->zRange($col_all, 0, 99, true);
getUserInfo($res_7, $manager);
$redis->set("rank_all", json_encode($res_7));

/** 参数加入& 采用引用传递，修改传入参数的值*/
function getUserInfo(&$res, $manager)
{
    foreach ($res as $key => $value) {
        $filter = ['user_id' => $key];
        $options = array(
            'limit' => 1
        );
        $query_find = new MongoDB\Driver\Query($filter, $options);
        $cursor = $manager->executeQuery('db_account.col_user', $query_find);
        $user_info = $cursor->toArray()[0];
        /** 插入玩家信息*/
        $info = new stdClass();
        $info->exp = $value;
        $info->nickname = $user_info->nickname;
        $info->openid = $user_info->openid;
        /** 将原玩家id转化为玩家信息对象*/
        $res[$key] = $info;
    }
}