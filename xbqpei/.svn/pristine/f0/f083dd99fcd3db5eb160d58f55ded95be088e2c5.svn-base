<?php
/**
 * 提交实名认证
 */

class submit_real_info
{
    public function index(){

        $root = get_baseroot();

		$request = $GLOBALS['request'];

        $real_name = $request['real_name'];
        $card = $request['card'];
        $user_id = intval($request['xbqp_user_id']);
        $face_card = $request['face_card'];
        $back_card = $request['back_card'];
        $sex = $request['sex'];
        $birthday = $request['birthday'];

        //验证
        if (!$user_id || !$real_name || !$card) {
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

        $sql = 'update ' . $GLOBALS['ecs']->table('users') . " set real_name = '$real_name',card='$card', sex='$sex', birthday='$birthday', status = '2'";
        if($face_card != '')
        {
            $sql .= " ,face_card = '$face_card'";
        }
        if($back_card != '')
        {
            $sql .= " ,back_card = '$back_card'";
        }
        $sql .= " where user_id = '" . $user_id . "'";
        logger::write('sql:' . $sql);
        $num = $GLOBALS['db']->query($sql);

        if ($num) {

            $root['response_code'] = 1;
            $root['status'] = 1;
            $root['show_err'] ="身份验证已提交，待审核";

        }else{
            $root['response_code'] = 0;
            $root['show_err'] ="未成功";
            $root['user_login_status'] = 0;
        }
        $root['program_title'] = "身份认证保存";
        output($root);		
    }
}
