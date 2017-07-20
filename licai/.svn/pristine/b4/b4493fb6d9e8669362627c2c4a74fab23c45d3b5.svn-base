<?php
/**
 * 同步用户密码
 */

class edit_pass
{
    public function index() {
		$root = get_baseroot();
		$request = $GLOBALS['request'];
        
		$root['program_title'] = "更新用户密码";

        if (!intval($request['xbqp_user_id'])) {
            $root['response_code'] = 0;
            $root['show_err'] = '未找到相关信息';
            output($root);
        }

        $user_data = array();
		$code = ''; //默认不使用code, 该值用于其他系统导入时的初次认证
		$user_data['user_pwd'] = md5($request['password'].$code);

        $GLOBALS['db']->table('user')->where('xbqp_user_id = ' . $request['xbqp_user_id'])->edit($user_data);
        $root['response_code'] = 1;
        output($root);

    }


	function check_user($user_data){
		//开始数据验证
		$res = array('status'=>1,'info'=>'','data'=>'','error_msg'=>''); //用于返回的数据
				
        //验证用户名
        if (isset($user_data['email'])) {
            if($res['status'] == 1 && trim($user_data['email'])=='')
            {
                $field_item['field_name'] = 'email';
                $field_item['error']	=	EMPTY_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where email = '".trim($user_data['email'])."' and id <> ".intval($user_data['id']))>0)
            {
                $field_item['field_name'] = 'email';
                $field_item['error']	=	EXIST_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }
        }
		
		if ($res['status'] == 0){
			$error = $res['data'];
			$error_msg = "";
			if(!$error['field_show_name'])
			{
				$error['field_show_name'] = $GLOBALS['lang']['USER_TITLE_'.strtoupper($error['field_name'])];
			}
			if($error['error']==EMPTY_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['EMPTY_ERROR_TIP'],$error['field_show_name']);
			}
			if($error['error']==FORMAT_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['FORMAT_ERROR_TIP'],$error['field_show_name']);
			}
			if($error['error']==EXIST_ERROR)
			{
				$error_msg = sprintf($GLOBALS['lang']['EXIST_ERROR_TIP'],$error['field_show_name']);
			}
			//showErr($error_msg);
		
			$res['error_msg'] = $error_msg;			
		}
		
		return $res;
	}
}
