<?php
/**
 * 同步用户邮箱
 */

class bind_email
{
    public function index() {
		$root = get_baseroot();
		$request = $GLOBALS['request'];
        
		$root['program_title'] = "更新用户邮箱";

        $user_id = intval($request['xbqp_user_id']);
        $email = $request['email'];

        //验证
        if (!$user_id || !$email) {
            $root['response_code'] = 0;
            $root['show_err'] = '未找到相关信息';
            output($root);
        } else {
            $user_info = $GLOBALS['db']->table('users')->where('user_id = ' . $user_id)->find();
            if (!$user_info) {
                $root['response_code'] = 0;
                $root['show_err'] = '未找到相关信息1';
                output($root);
            }
        }

        $result = $GLOBALS['db']->table('users')->where('user_id = ' . $user_id)->setField('email', $email);

        if ($result) {

            $root['response_code'] = 1;
            $root['show_err'] = 'success';
            output($root);
        }


        $root['response_code'] = 0;
        $root['show_err'] = 'edit fail';
        output($root);
    }


}
