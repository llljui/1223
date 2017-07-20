<?php

class register{
	public function index()
	{
        require_once (ROOT_PATH . 'includes/lib_passport.php');
		$root = get_baseroot();
		$user_name = trim($GLOBALS['request']['user_name']);//用户名
		$user_pwd = trim($GLOBALS['request']['user_pwd']);//密码
		$mobile = trim($GLOBALS['request']['mobile']);
        
		$root['program_title'] = "注册";

        $ecs = $GLOBALS['ecs'];
        $db = $GLOBALS['db'];

        //先查看这个手机号是否已注册, 已注册则更新密码，
        $user_id = $db->table('users')->where('mobile_phone = "' . $mobile . '"')->getField('user_id');
        if ($user_id) {
            $password = $GLOBALS['user']->compile_password(array(
				'password' => $user_pwd
            ));

            $arr = array(
                'password' => $password,
                'user_name' => $user_name
            );
            $db->table('users')->where('user_id = '  . $user_id)->setField($arr);

            $root['response_code'] = 1;
            $root['xbqp_user_id'] = $user_id;
            output($root);
        }
		
        $result = register_by_mobile($user_name, $user_pwd, $mobile);

        if ($result) {
        
			/* 把新注册用户的扩展信息插入数据库 */
			$sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id'; // 读出所有自定义扩展字段的id
			$fields_arr = $db->getAll($sql);
			
			$extend_field_str = ''; // 生成扩展字段的内容字符串
			foreach($fields_arr as $val)
			{
				$extend_field_index = 'extend_field' . $val['id'];
				if(! empty($_POST[$extend_field_index]))
				{
					$temp_field_content = strlen($_POST[$extend_field_index]) > 100 ? mb_substr($_POST[$extend_field_index], 0, 99) : $_POST[$extend_field_index];
					$extend_field_str .= " ('" . $_SESSION['user_id'] . "', '" . $val['id'] . "', '" . compile_str($temp_field_content) . "'),";
				}
			}
			$extend_field_str = substr($extend_field_str, 0, - 1);
			
			if($extend_field_str) // 插入注册扩展数据
			{
				$sql = 'INSERT INTO ' . $ecs->table('reg_extend_info') . ' (`user_id`, `reg_field_id`, `content`) VALUES' . $extend_field_str;
				$db->query($sql);
			}
			
			/* 写入密码提示问题和答案 */
			if(! empty($passwd_answer) && ! empty($sel_question))
			{
				$sql = 'UPDATE ' . $ecs->table('users') . " SET `passwd_question`='$sel_question', `passwd_answer`='$passwd_answer'  WHERE `user_id`='" . $_SESSION['user_id'] . "'";
				$db->query($sql);
			}
			
			/* 代码增加_start By bbs.hongyuvip.com */
			$now = gmtime();
			if($_CFG['bonus_reg_rand'])
			{
				$sql_bonus_ext = " order by rand() limit 0,1";
			}
			$sql_b = "SELECT type_id FROM " . $ecs->table("bonus_type") . " WHERE send_type='" . SEND_BY_REGISTER . "'  AND send_start_date<=" . $now . " AND send_end_date>=" . $now . $sql_bonus_ext;
			$res_bonus = $db->query($sql_b);
			$kkk_bonus = 0;
			while($row_bonus = $db->fetchRow($res_bonus))
			{
				$sql = "INSERT INTO " . $ecs->table('user_bonus') . "(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed)" . " VALUES('" . $row_bonus['type_id'] . "', 0, '" . $_SESSION['user_id'] . "', 0, 0, 0)";
				$db->query($sql);
				$kkk_bonus = $kkk_bonus + 1;
			}
			if($kkk_bonus)
			{
				$_LANG['register_success'] = '用户名 %s 注册成功,并获得官方赠送的红包礼品';
			}
			/* 代码增加_end By bbs.hongyuvip.com */
			
			/* 判断是否需要自动发送注册邮件 */
			if($GLOBALS['_CFG']['member_email_validate'] && $GLOBALS['_CFG']['send_verify_email'])
			{
				send_regiter_hash($_SESSION['user_id']);
			}

            $root['response_code'] = 1;
            $root['xbqp_user_id'] = $_SESSION['user_id'];
            output($root);
        } else {
            $root['response_code'] = 0;
            $root['error'] = $result['msg'];
            output($root);
        }

        $root['response_code'] = 0;
        $root['error'] = 'error';
        output($root);
    }

}
?>
