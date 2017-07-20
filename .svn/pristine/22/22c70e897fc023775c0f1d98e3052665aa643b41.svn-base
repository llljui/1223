<?php
/**
 * 同步用户实名认证
 */

class real_info
{
    private $user_id = 0;

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

        $user_id = $GLOBALS['db']->table('user')->where('xbqp_user_id = ' . $request['xbqp_user_id'])->getField('id');

        $this->user_id = $user_id;

        if (!intval($user_id)) {
            $root['response_code'] = 0;
            $root['show_err'] = '未找到相关信息';
            output($root);
        }

        $result = $this->check_user($request);
        logger::write('check:' . json_encode($result));

        $user_data = array();
        if ($result['status'] == 1) {
            $user_data['user_name'] = $request['user_name'];
            $user_data['real_name_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['real_name'])."','".AES_DECRYPT_KEY."')";
            $user_data['real_name'] = $request['real_name'];
            $user_data['idno_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['idno'])."','".AES_DECRYPT_KEY."')";
            $user_data['idno'] = $GLOBALS['request']['idno'];
            $user_data['byear'] = substr($GLOBALS['request']['idno'],6,4);
            $user_data['bmonth'] = substr($GLOBALS['request']['idno'],10,2);
            $user_data['bday'] = substr($GLOBALS['request']['idno'],12,2);
            $user_data['email_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['email'])."','".AES_DECRYPT_KEY."')";
            $user_data['email'] = $request['email'];
            if(getIDCardInfo(strim($GLOBALS['request']['idno']))==0){
                $root['show_err'] = "提交失败,身份证号码错误！"; 
                $root['response_code'] = 0;
                output($root);
            }
            if(get_user_info("count(*)","idno_encrypt = ".$user_data['idno_encrypt']." and id <> ".intval($user_id),"ONE")>0){
                $root['show_err'] = "提交失败,身份证号码已使用！"; 
                $root['response_code'] = 0;
                output($root);
            }

            $user_data['mobile'] = $GLOBALS['request']['mobile'];
            $user_data['mobile_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['mobile'])."','".AES_DECRYPT_KEY."')";
            $user_data['sex'] = $GLOBALS['request']['sex'];

            if (isset($GLOBALS['request']['user_pwd'])) {
                $code = ''; //默认不使用code, 该值用于其他系统导入时的初次认证
                $user_data['user_pwd'] = md5($request['user_pwd'].$code);
            }
            $GLOBALS['db']->table('user')->where('id = ' . $user_id)->edit($user_data);

            if (isset($GLOBALS['request']['face_card']) && isset($GLOBALS['request']['back_card'])) {
                $type = "credit_identificationscanning";
                $credit_type= load_auto_cache("credit_type");

                $field_array = array(
                    "credit_identificationscanning"=>"idcardpassed",
                );
                //$u_c_data[$field_array[$type]] = 0;

                $mode = "INSERT";
                $condition = "";

                $temp_info = $GLOBALS['db']->getRow("SELECT user_id,`type`,`file` FROM ".DB_PREFIX."user_credit_file WHERE user_id=".$user_id." AND type='".$type."'");
                if($temp_info){
                    $file_list = unserialize($temp_info['file']);
                    //认证是否过期
                    $time = TIME_UTC;
                    $expire_time = $credit_type['list'][$type]['expire']*30*24*3600;

                    $mode = "UPDATE";
                    $condition = "user_id=".$user_id." AND type='".$type."'";
                }
                $root['temp_info'] = $temp_info;
                $file = array();
                $file[] = $GLOBALS['request']['face_card'];
                $file[] = $GLOBALS['request']['back_card'];

                $data['user_id'] = $user_id;
                $data['type'] = $type;
                $data['status'] = 1;
                $data['file'] = serialize($file);
                $data['create_time'] = TIME_UTC;
                $data['passed'] = 1;
                $data['passed_time'] = TIME_UTC;
                $data['msg'] = '汽配操作';

                $GLOBALS['db']->autoExecute(DB_PREFIX."user_credit_file",$data,$mode,$condition);
            } 

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

            if($res['status'] == 1 && $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where user_name = '".trim($user_data['user_name'])."' and id <> ".intval($this->user_id))>0)
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

            if($res['status'] == 1 && $user_data['mobile']!=''&&$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where mobile_encrypt = AES_ENCRYPT('".trim($user_data['mobile'])."','".AES_DECRYPT_KEY."') and id <> ".intval($this->user_id))>0)
            {
                $field_item['field_name'] = 'mobile';
                $field_item['error']	=	EXIST_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }
        }
				
        if (isset($user_data['email'])) {
            if($res['status'] == 1 && trim($user_data['email'])=='')
            {
                $field_item['field_name'] = 'email';
                $field_item['error']	=	EMPTY_ERROR;
                $res['status'] = 0;
                $res['data'] = $field_item;			
            }

            if($res['status'] == 1 && $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where email = '".trim($user_data['email'])."' and id <> ".intval($this->user_id))>0)
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
