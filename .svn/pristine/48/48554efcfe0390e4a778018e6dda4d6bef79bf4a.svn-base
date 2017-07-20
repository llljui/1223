<?php
/**
 * 从金融过来的自动登录
 * @author wuzeguo
 */

define('IN_ECS', true);

require (dirname(__FILE__) . '/includes/init.php');

$data = $_GET;

//进行sign检测
include_once ROOT_PATH . 'syn_api/sign.php';
if (strlen($data['sign']) != 32 || !check_sign($data)) {
    app_redirect('/index.php');
}

$user_id = $data['xbqp_user_id'];
$pwd = $data['password'];

if (!$user_id || !$pwd) {
    app_redirect('/index.php');
} else {
    $user_info = $GLOBALS['db']->table('users')->where('user_id = ' . $user_id)->find();
    if (!$user_info) app_redirect('./index.php');
}

$status = $GLOBALS['user']->login($user_info['user_name'], $pwd);
app_redirect('/index.php');

//dump($_GET);die;
