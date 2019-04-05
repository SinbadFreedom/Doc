<?php
/**
 * Created by PhpStorm.
 * User: sinbad
 * Date: 2019/3/27
 * Time: 10:02
 */

const TYPE_TODAY = 1;
const TYPE_YESTERDAY = 2;
const TYPE_WEEK = 3;
const TYPE_WEEK_LAST = 4;
const TYPE_MONTH = 5;
const TYPE_MONTH_LAST = 6;
const TYPE_ALL = 7;

/** 排行榜类型 默认今日*/
$type = TYPE_TODAY;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

$time_stamp = time();
$today = date('Y-m-d', $time_stamp);
$file = 'log_rank_list_' . $today . '.log';
if (isset($_GET['userid'])) {
    $user_id = $_GET['userid'];
    $content = ' userid ' . $user_id . ' type ' . $type . " $time_stamp\n";
} else {
    $content = ' type ' . $type . " $time_stamp\n";
}
file_put_contents($file, $content, FILE_APPEND);


/** 获取redis的排行榜数据*/
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$key = null;
$title = "排行榜";
switch ($type) {
    case TYPE_TODAY:
        $key = 'rank_today';
        $title = "今日排行榜";
        break;
    case TYPE_YESTERDAY:
        $key = 'rank_yesterday';
        $title = "昨日排行榜";
        break;
    case TYPE_WEEK:
        $key = 'rank_week';
        $title = "本周排行榜";
        break;
    case TYPE_WEEK_LAST:
        $key = 'rank_week_last';
        $title = "上周排行榜";
        break;
    case TYPE_MONTH:
        $key = 'rank_month';
        $title = "本月排行榜";
        break;
    case TYPE_MONTH_LAST:
        $key = 'rank_month_last';
        $title = "上月排行榜";
        break;
    case TYPE_ALL:
        $key = 'rank_all';
        $title = "总排行榜";
        break;
}

if ($key) {
    $res = $redis->get($key);
    $rank_list = json_decode($res);
    if ($rank_list && sizeof($rank_list) > 0) {

        /**
         * <ul>
         * <li style="display: flex">
         * <div class="col-md-4 col-sm-4 col-xs-4">
         * <img class="img-responsive center-block" src="" width="50px" height="50px">
         * </div>
         * <div class="col-md-4 col-sm-4 col-xs-4">
         * 姓名
         * </div>
         * <div class="col-md-4 col-sm-4 col-xs-4">
         * 经验
         * </div>
         * </li>
         * </ul>
         */
        $note_list_content = '<ul>';
        foreach ($rank_list as $value) {

            $open_id = $value->openid;
            $nick_name = $value->nickname;
            $exp = $value->exp;

            $note_list_content .= '<li style="display: flex">'
                . '<div class="col-md-4 col-sm-4 col-xs-4">'
                . '<img class="img-responsive center-block" src="../head_img/' . $open_id . '.jpg" width="50px" height="50px">'
                . '</div>'
                . '<div class="col-md-4 col-sm-4 col-xs-4">'
                . $nick_name
                . '</div>'
                . '<div class="col-md-4 col-sm-4 col-xs-4">'
                . $exp
                . '</div>'
                . '</li>';
        }
        $note_list_content .= '</ul>';
    } else {
        $note_list_content = "尚没有排行榜数据，敬请期待。昨日排行榜每日更新，上周排行榜每周更新，上月排行榜每月更新。";
    }
}
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://dashidan.com/and_doc/lib/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="https://dashidan.com/and_doc/lib/google-code-prettify/run_prettify.js"></script>
    <link rel="stylesheet" href="https://dashidan.com/css/dashidan.css">
</head>
<body>
<div class="col-md-12 text-center">
    <h2>
        <?php echo $title; ?>
    </h2>
</div>
<div class="col-md-12 text-center">
    <?php
    echo $note_list_content;
    ?>
</div>
</body>
</html>