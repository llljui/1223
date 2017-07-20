<?php
/**
 * 同步用户信息接口
 */

class edit_user 
{
    public function index() {
		$root = get_baseroot();
		$request = $GLOBALS['request'];
        
		$root['program_title'] = "更新用户信息";

        if ($request['check'] == 1) { 
            $result = $this->check_user($request);
            if ($result['status'] == 1) {
                $root['response_code'] = 1;
                output($root);
            } else {
                $root['response_code'] = 0;
                output($root);
            }
        }

        if (!intval($request['xbqp_user_id'])) {
            $root['response_code'] = 0;
            $root['show_err'] = '未找到相关信息';
            output($root);
        }

        $result = $this->check_user($request);
        $user_data = array();
        if ($result['status'] == 1) {
            $user_data['user_name'] = $request['user_name'];
            $user_data['byear'] = $request['byear'];
            $user_data['bmonth'] = $request['bmonth'];
            $user_data['bday'] = $request['bday'];
            $user_data['sex'] = $request['sex'];

            $GLOBALS['db']->table('user')->where('xbqp_user_id = ' . $request['xbqp_user_id'])->edit($user_data);
            $root['response_code'] = 1;
            output($root);
        }

        $root['response_code'] = 0;
        $root['show_err'] = $result['error_msg'];
        output($root);
    }


	function check_user($user_data){
		//开始数据验证
		$res = array('status'=>1,'info'=>'','data'=>'','error_msg'=>''); //用于返回的数据
				
        //验证用户名
        if (isset($user_data['user_name'])) {
            if($res['status'] == 1 && trim($user_data['user_name'])=='')
            {
                $field_item['field_name'] = 'user_name';
                $field_item['error']	=	EMPTY_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && trim(strLen($user_data['user_name']) > 15 || strLen($user_data['user_name']) < 3))
            {
                $field_item['field_name'] = 'user_name';
                $field_item['error']	=	FORMAT_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where user_name = '".trim($user_data['user_name'])."' and id <> ".intval($user_data['id']))>0)
            {
                $field_item['field_name'] = 'user_name';
                $field_item['error']	=	EXIST_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }
        }
		
        //验证手机号 
        if (isset($user_data['mobile'])) {
            if($res['status'] == 1 && trim($user_data['mobile'])=='')
            {
                $field_item['field_name'] = 'mobile';
                $field_item['error']	=	EMPTY_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && !check_mobile(trim($user_data['mobile'])))
            {
                $field_item['field_name'] = 'mobile';
                $field_item['error']	=	FORMAT_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && $user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where mobile = '" . trim($user_data['mobile']) . "' or mobile_encrypt = AES_ENCRYPT('".trim($user_data['mobile'])."','".AES_DECRYPT_KEY."') and id <> ".intval($user_data['id']))>0)
            {
                $field_item['field_name'] = 'mobile';
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
