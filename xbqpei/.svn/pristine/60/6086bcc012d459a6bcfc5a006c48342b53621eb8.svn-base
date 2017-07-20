<?php
/**
 * 跳转到小滨理财页面
 */
define('IN_ECS', true);

require (dirname(__FILE__) . '/includes/init.php');

//提交
require_once (dirname(__FILE__) . '/includes/cls_syn_user.php');
$syn_obj = new cls_syn_user();
$post_url = $syn_obj->_domain . '/from_xiaobin.php';

//先判断本地是否登录
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '')
{
    header("Location: ". $post_url); 
}

$user_id = $_SESSION['user_id'];
$user_info = $db->table('users')->where('user_id = ' . $user_id)->find();

if (!$user_info)
{
    header("Location: ". $post_url); 
}

$data = array(
    'xbqp_user_id' => $user_info['user_id'],
    'password' => $user_info['password']
);
unset($user_info);

$data = $syn_obj->preHandleData($data); //have sign
$url_data = '';
foreach ($data AS $k=>$v) {
    $url_data .= '&' . $k . '=' .$v;
}
$url_data = substr($url_data,1);
$post_url .= '?' . $url_data;
echo '<script>window.location.href="' . $post_url . '"</script>';

//$obj = $syn_obj->syn_login($data);
//if ($obj->response_code == 1 && $obj->user_login_status == 1) {
//    echo '<script>window.location.href="http://www.bangbang.com"</script>';
//}

