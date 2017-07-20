<?php
//过滤请求
function mapi_filter_request(&$request)
{
    foreach($request as $k=>$v)
    {
        if(is_array($v))
        {
            mapi_filter_request($request[$k]);
        }
        else
        {
            $request[$k] = stripslashes(trim($v));
        }
    }

}

mapi_filter_request($_GET);
$data = $_GET;

if(!defined('ROOT_PATH'))
	define('ROOT_PATH', str_replace('from_xiaobin.php', '', str_replace('\\', '/', __FILE__)));

require ROOT_PATH.'system/common.php';
require_once ROOT_PATH . '/syn_api/sign.php';
if (strlen($data['sign']) != 32 || !check_sign($data)) {
    logger::write('sign error');
	app_redirect("./index.php");
}
//var_dump($data);die;

$pwd = $data['password'];//密码
$xbqp_user_id = $data['xbqp_user_id']; //小滨汽配的关联号
if (!$xbqp_user_id) {
	app_redirect("./index.php");
} else {
    $user_info = $GLOBALS['db']->table('user')->where('xbqp_user_id = ' . $xbqp_user_id)->find();
    if (!$user_info) {
        app_redirect("./index.php");
    }
}

$user_name = $user_info['user_name'] ? $user_info['user_name'] : $user_info['mobile'];

require_once ROOT_PATH."system/libs/user.php";
$result = do_login_user($user_name,$pwd);

if ($result['status']) {
}
app_redirect("./index.php");
