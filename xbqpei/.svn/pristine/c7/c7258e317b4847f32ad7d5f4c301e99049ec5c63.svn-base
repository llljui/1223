<?php
/**
 * 请求目的地址接口，同步数据
 * @todo 
 *  1, 用户注册同步
 *  2, 用户session同步
 *  3, 修改用户信息同步
 * @author wuzeguo
 * @date 2017-5-26
 */

class cls_syn_user
{
    private $_key = '';
    private $_httpUrl = '';
    public $_domain = '';

    public function __construct()
    {
        require(dirname(__FILE__) . '/../data/curl_config.php');

        if (!$is_open) return true;

        $this->_key= $curl_key;
        $this->_httpUrl = $httpUrl;
        $this->_domain = $domain;
    }

    //用户注册同步
    //$data = array(
    //    'user_name' => $username,
    //    'user_pwd' => $password,
    //    'user_pwd_confirm' => $password,
    //    'mobile'   => $mobile_phone,
    //    'xbqp_user_id' => $_SESSION['user_id'],
    //);
    public function syn_register_user($user_data)
    {
        $user_data['act'] = 'register';
        $this->curlPost($user_data);
    }

    //用户session
    #public function getSynUserSession($user_data)
    #{
    #    $user_data['act'] = 'syn_session';
    #    return $this->curlPost($user_data);
    #}

    //同步登录
    public function syn_login($user_data) 
    {
        $user_data['act'] = 'login';
        return $this->curlPost($user_data);
    }

    //修改用户信息同步
    //1, 检测
    //$data = array(
    //    'user_name' => $username,
    //    'byear' => $byear,
    //    'bmonth' => $bmonth,
    //    'bday' => $bday,
    //    'sex'      => isset($_POST['sex']) ? intval($_POST['sex']) : -1,
    //    'check' => 1
    //);
    //2, 修改
    //$data = array(
    //    'user_name' => $username,
    //    'byear' => $byear,
    //    'bmonth' => $bmonth,
    //    'bday' => $bday,
    //    'sex'      => isset($_POST['sex']) ? intval($_POST['sex']) : -1,
    //    'xbqp_user_id' => $user_id
    //);
    public function syn_edit_user($user_data)
    {
        $user_data['act'] = 'edit_user';
        return $this->curlPost($user_data);
    }

    //绑定邮箱
    public function syn_bind_email($user_data)
    {
        $user_data['act'] = 'bind_email';
        $user_data['xbqp_user_id'] = $_SESSION['user_id'];
        return $this->curlPost($user_data);
    }

    //修改密码
    //忘记密码 
    //$data = array(
    //    'password'   => $password,
    //    'xbqp_user_id' => $user['user_id']
    //);
    public function syn_edit_pass($user_data)
    {
        $user_data['act'] = 'edit_pass';

        if (!$user_data['xbqp_user_id']) {
            $user_data['xbqp_user_id'] = $_SESSION['user_id'];
        }
        return $this->curlPost($user_data);
    }

    //提交实名认证
    public function syn_submit_real_info($user_data) 
    {
        $user_data['act'] = 'submit_real_info';
        $user_data['xbqp_user_id'] = $_SESSION['user_id'];
        return $this->curlPost($user_data);
    }

    //实名认证通过
    public function syn_real_info($user_data)
    {
        $user_data['act'] = 'real_info';
        return $this->curlPost($user_data);
    }


    //数据预处理
    public function preHandleData($data)
    {
        if (!is_array($data)) return false;

        //过滤特殊字段
        $fiter_field = array('money', 'lock_money');
        foreach ($data AS $k => $v) {
            if (in_array($k, $fiter_field)) {
                unset($data[$k]);
            }

            //性别转化
            if ($k == 'sex') {
                $data[$k] = $this->syn_conver_sex($v);
            }
        }

        $sign = $this->generateSign($data);

        $data['sign'] = $sign;

        return $data;
    }

    /**
     * 同步数据时性别转化
     * @param string $sex
     * @return string $sex
     * @author wuzeguo
     * @todo 小滨： 1男， 2女, 保密0
     *       金融： 1男， 0女, 未知-1
     */
    function syn_conver_sex($sex=0)
    {
        return $sex == 1 ? 1 : ($sex == 0 ? -1 : 0);
    }


    //生成签名
    public function generateSign($data)
    {
        ksort($data);

        $sign = '';
        foreach ($data as $key => $val) {
            if ($val !== '' && $key != 'sign') {
                $sign .= '&' . $key . '=' .stripslashes(trim($val));
            }
        }

        return md5(substr($sign,1).$this->_key);
    }


    //请求操作
    //$data 请求的数据
    //$url 请求地址，不包含域名
    public function curlPost($data)
    {
        if (is_array($data)) {

            $data = $this->preHandleData($data);

            $url = $this->_httpUrl;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // post数据
            curl_setopt($ch, CURLOPT_POST, 1);
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            $output = curl_exec($ch);
            curl_close($ch);

            //打印获得的数据
            return json_decode(base64_decode($output));   
            //die;
        }

        return false;
    }
}
