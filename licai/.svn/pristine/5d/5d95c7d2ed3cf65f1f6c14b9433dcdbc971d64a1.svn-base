<?php

class register{

	public function index()
	{
		//require_once APP_ROOT_PATH."system/libs/user.php";
		$root = get_baseroot();
		$user_name = strim($GLOBALS['request']['user_name']);//用户名
		$user_pwd = strim($GLOBALS['request']['user_pwd']);//密码
		$user_pwd_confirm = strim($GLOBALS['request']['user_pwd_confirm']);		
		$mobile = strim($GLOBALS['request']['mobile']);
		$xbqp_user_id = intval($GLOBALS['request']['xbqp_user_id']);
        
		$root['program_title'] = "注册";
		
		$user_data = array(
			'mobile'            => $mobile,
			'user_name'        => $user_name,
			'user_pwd'         => $user_pwd,		
			'user_pwd_confirm'   => $user_pwd_confirm,
		);
		
		$check_status = $this->check_user($user_data);

        logger::write(json_encode($check_status));

		if ($check_status['status'] == 1){
				require_once APP_ROOT_PATH."system/libs/user.php";
				
				$user_id = $this->add_user($user_data);
				
				if($user_id)
				{
                    //xbqp_user_id
                    $GLOBALS['db']->table('user')->where('id = ' . $user_id)->setField('xbqp_user_id', $xbqp_user_id);

					$result = user_login($user_name,$user_pwd);					
					if($result['status'])
					{
						
						$user_data = $GLOBALS['user_info'];//$result['user'];
						$root['response_code'] = 1;
						$root['user_login_status'] = 1;//用户登陆状态：1:成功登陆;0：未成功登陆
						$root['show_err'] = "用户注册登陆成功";
						$root['id'] = $user_data['id'];
						$root['user_name'] = $user_data['user_name'];
						$root['user_pwd'] = $user_data['user_pwd'];
						$root['user_money'] = $user_data['money'];
						$root['user_money_format'] = format_price($user_data['money']);//用户金额
						
						output($root);
					
					}else{
						$root['response_code'] = 0;
						$root['user_login_status'] = 0;//用户登陆状态：1:成功登陆;0：未成功登陆
						$root['show_err'] = "会员注册失败.";
						output($root);
					}
				}else
				{
					$root['response_code'] = 0;
					$root['user_login_status'] = 0;//用户登陆状态：1:成功登陆;0：未成功登陆
					$root['show_err'] = "会员注册失败.";
					output($root);
				}
			//output($root);
		}else{
            //如果用户已存（以手机号为准), 则进行更新操作
            $field_name = $check_status['data']['field_name'];
            $error = $check_status['data']['error'];

            //logger::write('data:' . json_encode($check_status['data']));

            if (($field_name == 'mobile' && $error == EXIST_ERROR) || ($field_name == 'user_name' && $error == EXIST_ERROR)) {
                $user_id = $GLOBALS['db']->table('user')->where('mobile_encrypt = AES_ENCRYPT("' . $mobile . '", "' . AES_DECRYPT_KEY . '")')->getField('id');
                if ($user_id) {
                    //同步密码及关联起来
                    $code = ''; //默认不使用code, 该值用于其他系统导入时的初次认证
                    $user_pwd = md5($user_data['user_pwd'].$code);
                    $data = array(
                        'user_name' => $user_data['user_name'],
                        'user_pwd' => $user_pwd,
                        'xbqp_user_id' => $xbqp_user_id,
                    );
                    $result = $GLOBALS['db']->table('user')->where('id = ' . $user_id)->edit($data);

                    $root['response_code'] = 1;
                    $root['show_err'] = 'success';
                    output($root);
                }
            }

			$root['response_code'] = 0;
			$root['user_login_status'] = 0;//用户登陆状态：1:成功登陆;0：未成功登陆
			$root['show_err'] = $check_status['error_msg'];
			output($root);
		}
		
		output($root);
	}
	
	function check_user($user_data){
        logger::write(json_encode($user_data));
		//开始数据验证
		$res = array('status'=>1,'info'=>'','data'=>'','error_msg'=>''); //用于返回的数据

        //password
		if($user_data['user_pwd'] != $user_data['user_pwd_confirm'])
		{			
			$res['status'] = 0;
			$res['error_msg'] = $GLOBALS['lang']['USER_PWD_CONFIRM_ERROR'];
			return  $res;
		}
		
		if(trim($user_data['user_pwd'])=='')
		{
			$res['status'] = 0;
			$res['error_msg'] = $GLOBALS['lang']['USER_PWD_ERROR'];
			return  $res;
		}		
		

        //mobile
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
		
		//if($res['status'] == 1 && $user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where mobile = '".trim($user_data['mobile'])."' and id <> ".intval($user_data['id']))>0)
		if($res['status'] == 1 && $user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where mobile_encrypt = AES_ENCRYPT('".trim($user_data['mobile'])."','".AES_DECRYPT_KEY."')")>0)
		{
			$field_item['field_name'] = 'mobile';
			$field_item['error']	=	EXIST_ERROR;
			$res['status'] = 0;
			$res['data'] = $field_item;			
		}
				
        //user_name
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

        //end
		
		
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
	
	
	
	
	/**
	 * 生成会员数据
	 * @param $user_data  提交[post或get]的会员数据
	 * @param $mode  处理的方式，注册或保存
	 * 返回：data中返回出错的字段信息，包括field_name, 可能存在的field_show_name 以及 error 错误常量
	 * 不会更新保存的字段为：score,money,verify,pid
	 */
	function add_user($user_data)
	{
		
		//$res = array('status'=>1,'id'=>0); //用于返回的数据
		
		//验证结束开始插入数据
		$user_id = 0;
		
		$user['user_name'] = $user_data['user_name'];
		$user['create_time'] = TIME_UTC;
		$user['create_date'] = to_date(TIME_UTC,"Y-m-d");
		$user['update_time'] = TIME_UTC;
		$user['pid'] = (int)$user_data['pid'];	
		$user['referer_memo'] = $user_data['referer_memo'];
	
		//获取默认会员组, 即升级积分最小的会员组
		$user['group_id'] = $GLOBALS['db']->getOne("select id from ".DB_PREFIX."user_group order by score asc limit 1");
		
        $user['is_effect'] = 1;
        $user['mobile'] = $user_data['mobile'];
        $user['mobile_encrypt'] = " AES_ENCRYPT('".$user_data["mobile"]."','". AES_DECRYPT_KEY."') ";
        $user['mobilepassed'] = 1;//是否已经绑定手机；1：是；0：否; 手机注册的，直接就绑定手机了;
		$user['code'] = ''; //默认不使用code, 该值用于其他系统导入时的初次认证
		$user['user_pwd'] = md5($user_data['user_pwd'].$user['code']);
		
		/*
		//载入会员整合，手机端没填：email，暂时不做会员整合;
		$integrate_code = trim(app_conf("INTEGRATE_CODE"));
		if($integrate_code!='')
		{
			$integrate_file = APP_ROOT_PATH."system/integrate/".$integrate_code."_integrate.php";
			if(file_exists($integrate_file))
			{
				require_once $integrate_file;
				$integrate_class = $integrate_code."_integrate";
				$integrate_obj = new $integrate_class;
			}
		}
		
		//同步整合
		if($integrate_obj)
		{
			$res = $integrate_obj->add_user($user_data['user_name'],$user_data['user_pwd'],$user_data['email']);
			$user['integrate_id'] = intval($res['data']);
	
			if(intval($res['status'])==0) //整合注册失败
			{
				return $res;
			}
		}
		
		 $s_api_user_info = es_session::get("api_user_info");
		$user[$s_api_user_info['field']] = $s_api_user_info['id'];
		es_session::delete("api_user_info");
		*/
		if($GLOBALS['db']->autoExecute(DB_PREFIX."user",$user,'INSERT'))
		{
			$user_id = $GLOBALS['db']->insert_id();
			
			if((int)app_conf("OPEN_IPS") > 0){
				$email = get_site_email($user_id);
				//$GLOBALS['db']->query("UPDATE ".DB_PREFIX."user SET email='$email' where id=".$user_id);
				$GLOBALS['db']->query("UPDATE ".DB_PREFIX."user SET email_encrypt = AES_ENCRYPT('".$email."','".AES_DECRYPT_KEY."') where id=".$user_id);
			}
			
			
			
			send_register_reward($user_id,"",$user['pid']);
		
		}
		
		
		
		
		return $user_id;
	}
	
}
?>
