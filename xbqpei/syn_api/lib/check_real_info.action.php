<?php
/**
 * 同步实名认证结果
 */
class check_real_info
{
    public function index(){

        $root = get_baseroot();

        $request = $GLOBALS['request'];

        $ispassed= $request['ispassed'];
        $user_id = intval($request['xbqp_user_id']);

        //验证
        if (!$user_id || !$ispassed) {
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

        $ispassed = ($ispassed == 1) ? 1 : 3; 

        $result = $GLOBALS['db']->table('users')->where('user_id = ' . $user_id)->setField('status', $ispassed);

        if ($result) {
            $root['response_code'] = 1;
            $root['show_err'] = '更新成功';
            output($root);
        }
        $root['response_code'] = 0;
        $root['show_err'] = '更新失败';
        output($root);
    }

}
