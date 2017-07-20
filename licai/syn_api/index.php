<?php 
// +----------------------------------------------------------------------
// | 邦邦理财 mapi 插件
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.bangbanglicai.com All rights reserved.
// +----------------------------------------------------------------------

if(!defined("MAGIC_QUOTES_GPC")){
    @set_magic_quotes_runtime (0);
    define('MAGIC_QUOTES_GPC',get_magic_quotes_gpc()?True:False);
}

//过滤请求
function mapi_filter_request(&$request)
{
    if(MAGIC_QUOTES_GPC)
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

}

$_REQUEST = $_POST;
mapi_filter_request($_REQUEST);

$request = $_REQUEST;

require '../system/common.php';
require '../app/Lib/common.php';
require './lib/functions.php';
require '../system/libs/user.php';
require 'sign.php';

logger::write('**********************************');
logger::write('**********************************');
logger::write('**********************************');
logger::write('**********sign start***********');
logger::write('data:' . json_encode($_POST));

//验证数据合法性
if (!$request['sign'] || !check_sign($request)) {
logger::write('sign error');
    header("Content-Type:text/html; charset=utf-8");
    exit("Hack attemp!");
}
logger::write('**********sign end***********');

if(!defined("APP_INDEX"))
	define("APP_INDEX","index");
	

if (!isset($request['from']) || empty($request['from'])){
	$request['from'] = 'xb';
}

$GLOBALS['request'] = $request;


//$sessid = $request['session_id'];
//
//if (empty($sessid)){
//	$sessid = es_session::id();
//	$request['session_id'] = $sessid;
//}
//
//es_session::set_sessid($sessid);


define('VERSION',1); //接口版本号,float 类型
define("CACHE_TIME",60); //动态数据缓存时间，300秒
if (intval($m_config['page_size']) == 0){
	define('PAGE_SIZE',20); //分页的常量
}else{
	define('PAGE_SIZE',intval($m_config['page_size'])); //分页的常量
}

$class = strtolower(strim($request['act']));
$act2 = strtolower(strim($request['act_2']))?strtolower(strim($request['act_2'])):"";
define('ACT',$class); //act常量
define('ACT_2',$act2);

logger::write('------------app start---------');
logger::write('class:' . $class);


//$GLOBALS['user_info'] = es_session::get("user_info");
//
//if(empty($GLOBALS['user_info']) && $class != 'login')
//{
//	$cookie_uname = strim($request['email']);//用户名或邮箱
//	$cookie_upwd = strim($request['pwd']);//密码
//	
//	if($cookie_uname!=''&&$cookie_upwd!='')
//	{
//		$cookie_uname = strim($cookie_uname);
//		if (strlen($cookie_upwd) != 32)
//			$cookie_upwd = md5($cookie_upwd);
//		$cookie_upwd = md5($cookie_upwd."_EASE_COOKIE");
//		auto_do_login_user($cookie_uname,$cookie_upwd);
//		$GLOBALS['user_info'] = es_session::get('user_info');
//	}
//}
//else{
//    $GLOBALS['user_info'] = get_user_info("*","id=".$GLOBALS['user_info']['id']);
//    es_session::set('user_info',$GLOBALS['user_info']);
//}

if(true) 
{
    $requestData = base64_encode(json_encode($request));
	$syn_api_log = array();
	$syn_api_log['api'] = $requestData;
	$syn_api_log['act'] = $class;
	$GLOBALS['db']->autoExecute(DB_PREFIX."syn_api_log", $syn_api_log, 'INSERT');
}

//公共初始化
if(file_exists("./lib/".$class.".action.php"))
{	
	require_once "./lib/".$class.".action.php";			
	if(class_exists($class))
	{
		$obj = new $class;		
		if(method_exists($obj,"index"))
		{
logger::write('------------app end---------');
			$obj->index();
		}
		else
		{
			header("Content-Type:text/html; charset=utf-8");
			exit("Hack attemp!");
		}
	}
	else
	{
logger::write('--class no exists ---');
		header("Content-Type:text/html; charset=utf-8");
		exit("Hack attemp!");
	}
}
else
{
logger::write('--class file no exists ---');
	header("Content-Type:text/html; charset=utf-8");
	exit("Hack attemp!".ACT);
}

?>
