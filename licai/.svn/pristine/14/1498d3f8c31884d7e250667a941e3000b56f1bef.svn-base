<?php
//登录并返回session_id
class syn_session
{
	public function index()
	{
		$root = get_baseroot();
		$user_name = strim($GLOBALS['request']['user_name']);//用户名
		$mobile = strim($GLOBALS['request']['mobile']);
        $xbqp_user_id = intval($GLOBALS['request']['xbqp_user_id']);
        
		$root['program_title'] = "获取sessionID";
		
		$user_data = array(
			'mobile'            => $mobile,
			'user_name'        => $user_name,
		);
        $sql = 'select * from ' . DB_PREFIX . 'user where mobile = ' . $mobile . ' AND xbqp_user_id = ' . $xbqp_user_id;
        $user_info = $GLOBALS['db']->getRow($sql);				
        if ($user_info) {
            require_once APP_ROOT_PATH."system/libs/user.php";
            $result = user_login($user_name,$user_pwd);					
            es_session::set("user_info",$user_info);

            $sessid = es_session::id();
            es_session::set_sessid($sessid);

            $root['response_code'] = 1;
            $root['user_login_status'] = 1;//用户登陆状态：1:成功登陆;0：未成功登陆
            $root['show_err'] = "用户登陆成功";		
            $root['id'] = $user_info['id'];
            $root['user_name'] = $user_info['user_name'];
            $root['mobile'] = $user_info['mobile'];
        } else {

            $root['response_code'] = 0;
            $root['user_login_status'] = 0;//用户登陆状态：1:成功登陆;0：未成功登陆
            $root['show_err'] = '未登录';
            $root['id'] = 0;
            $root['user_name'] = $user_name;
            $root['mobile'] = $mobile;					
        }

		output($root);		
    }
}
