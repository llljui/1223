<?php

// +----------------------------------------------------------------------
// | 邦邦理财
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jobin.lin(jobin.lin@gmail.com)
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | 国付报 直连银行支付
// +----------------------------------------------------------------------
$payment_lang = array(
	'name'	=>	'快捷支付',
	'merchant_id'	=>	'合作者身份ID',
	//'virCardNoIn'	=>	'富友账户',
	'private_RSA'		=>	'私钥',
	'public_RSA'		=>	'公钥',
	'GO_TO_PAY'	=>	'前往富友在线支付',
	'VALID_ERROR'	=>	'支付验证失败',
	'PAY_FAILED'	=>	'支付失败',
);
$config = array(
    'merchant_id' => '', //商户ID
    'private_RSA'=>array(
    	'INPUT_TYPE'	=>	'4',
    ),  //商RSA
    'public_RSA'=>array(
    	'INPUT_TYPE'	=>	'4',
    ),  
);

/* 模块的基本信息 */
if (isset($read_modules) && $read_modules == true){
    
    /* 会员数据整合插件的代码必须和文件名保持一致 */
    $module['class_name']    = 'Fuyouquai';

    /* 被整合的第三方程序的名称 */
    $module['name'] = $payment_lang['name'];
    
    /* 支付方式：1：在线支付；0：线下支付 */
    $module['online_pay'] = '1';
	
	 /* 配送 */
    $module['config'] = $config;
    $module['lang'] = $payment_lang;
    
    $module['reg_url'] = 'https://pay.fuiou.com/dirPayGate.do';
    
    return $module;
}

// 富友模型
require_once(APP_ROOT_PATH.'system/libs/payment.php');
class Fuyouquai_payment implements payment {

    public $_mchnt_cd;
    public $_order_id;
    public $_order_amt;
    public $_user_type = 0;
    public $_page_notify_url;
    public $_back_notify_url;
    public $_card_no;
    public $_cert_type =0; //身份证
    public $_cert_no;
    public $_cardholder_name;
    public $_user_id;
    public $_private_RSA;
    public $_public_RSA;
    public $_payment_info;

    //初始化
    function __construct()
    {
        $this->_page_notify_url = SITE_DOMAIN.APP_ROOT.'/callback/pay/fuyouquai_callback.php?act=notify';
        $this->_back_notify_url = SITE_DOMAIN.APP_ROOT.'/callback/pay/fuyouquai_callback.php?act=response'; //后台通知URL

		$this->_payment_info = $GLOBALS['db']->getRow("select id,config,logo from ".DB_PREFIX."payment where class_name ='Fuyouquai'");
		$this->_payment_info['config'] = unserialize($this->_payment_info['config']);
        $this->_mchnt_cd = $this->_payment_info['config']['merchant_id']; //商户代码
        $this->_private_RSA = $this->_payment_info['config']['private_RSA']; //商户key
        //$this->_private_RSA = 'MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAJMr8NnRV7ve7Y5FEBium/TsU0fK5NvzvFpsYxPAQhBXY+EN0Bi2JEg790C1njk9Q3U36u2JBDHAiDIomlgh6wWkJsFn7dghV/fCWSX1VVJ+dRINZy1432fRaJ8GqspvMneBpeLjBe94IwlWKpN+AOR+BNX8QL/uHmfCPlVQXos9AgMBAAECgYAzqbMs434m50UBMmFKKNF6kxNRGnpodBFktLO7FTybu/HF6TFp21a1PMe5IYhfk5AAsBZ6OCUOygWFhhdYZN+5W+dweF3kp1rLE4y5CjwqNlk/g22TAndf9znh/ltHFLvITToqu/eh/34tE1gyNxRbsi1olw/1wv8ZRjM3vtM9QQJBANvNwFq+CJHUyFzkXQB7+ycQFnY8wDq8Uw2Hv9ZMjgIntH7FSlJtdu5mAYPPo6f74slO5tFUMNP7EVppqsjYaNkCQQCraD6iKHo+OIlvvYIKiMXatJGD7N1GNhq5CrhUNPWLHwv/Ih2D3JJdF8IUZOPIJfUxTfM2fZYI+EVdsv6s4RcFAkAGjNYbnighOGcUJZYD6q3sVxVkRqEv3ubWs2HrH/Lna4l8caKqXCq8JfwLkod8/QugFiLYwBqIZqX4vMdjHtfZAkBsAl9dbWZCaPvpxp/4JWGPxDLhz9NLV/KU4bVvkoObq++yUHwKyGYOdVcd5MlIKOsNq5Hzp0Vw14lWVuF2bMxFAkBuNrZksvUULNIaWDKd4rQ6GVzUxXuIZW0ZE6atHYDiXPB4jVAjKRtLxZAV1qH9cr1zNJlcg+RbGYUdF9t4A9n5';

        $this->_public_RSA = $this->_payment_info['config']['public_RSA']; //商户key
		$this->_user_id = $GLOBALS['user_info']['id'];
        $this->_cert_no = $GLOBALS['user_info']['idno'];

        //银行卡信息
        $bank_info = $GLOBALS['db']->getRow('select * from ' . DB_PREFIX . 'user_bank where user_id = ' . $this->_user_id);
        $this->_card_no = str_replace(' ', '', $bank_info['bankcard']);
        $this->_cardholder_name = $bank_info['real_name'];
    }

    public function get_payment_code($payment_notice_id) {
        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = ".$payment_notice_id);

		$this->_order_id = $payment_notice['notice_sn'];
		$this->_order_amt = intval($payment_notice['money'] * 100);

        //拼接数据
        $_data = "";
        $_data .= $this->_mchnt_cd."|";
        $_data .= $this->_user_id."|";
        $_data .= $this->_order_id."|";
        $_data .= $this->_order_amt."|";
        $_data .= $this->_card_no."|";
        $_data .= $this->_cardholder_name."|";
        $_data .= $this->_cert_type."|";
        $_data .= $this->_cert_no."|";
        $_data .= $this->_page_notify_url."|";
        $_data .= $this->_back_notify_url;

        $rsaKey = $this->_private_RSA;

        $dataGBK = iconv('UTF-8', 'GBK', $_data);
        $pemKey = chunk_split($rsaKey, 64, "\n");
        $pem = "-----BEGIN PRIVATE KEY-----\n" . $pemKey . "-----END PRIVATE KEY-----\n";
        $priKey = openssl_pkey_get_private($pem);

        openssl_sign($dataGBK, $encrypted, $priKey, OPENSSL_ALGO_MD5); // 对数据进行签名
        $RSA = base64_encode($encrypted);

        /*交易参数*/
        $parameter = array(
            "mchnt_cd" => $this->_mchnt_cd,
            "order_id" => $this->_order_id,
            "order_amt" => $this->_order_amt,
            "user_type" => $this->_user_type,
            "page_notify_url" => $this->_page_notify_url,
            "back_notify_url" => $this->_back_notify_url,
            "card_no" => $this->_card_no,
            "cert_type" => $this->_cert_type,
            "cert_no" => $this->_cert_no,
            "cardholder_name" => $this->_cardholder_name,
            "user_id" => $this->_user_id,
            "RSA" => $RSA, 
        );
        
        //$url = 'https://pay.fuiou.com/dirPayGate.do';
        $url = 'http://www-1.fuiou.com:8888/wg1_run/dirPayGate.do';
        //return array(
         //   'url' => $url,
          //  'parameter' => $parameter
        //);

        $def_url = '<form style="text-align:center;" action="'.$url.'" target="_blank" style="margin:0px;padding:0px" method="post" >';

        foreach ($parameter AS $key => $val) {
           $def_url .= "<input type='hidden' name='$key' value='$val' />";
        }
        $def_url .= "<input type='submit' class='paybutton' value='前往富友在线支付' />";
        $def_url .= "</form>";
        $def_url.="<br /><div style='text-align:center' class='red'>".$GLOBALS['lang']['PAY_TOTAL_PRICE'].":".format_price($this->_order_amt/100)."</div>";
        return $def_url;
    }

    public function response($request) {
		$return_res = array(
            'info' => '',
            'status' => false,
        );

        // 获得返回的数据
        $mchnt_cd = $_POST['mchnt_cd'];
        $order_id = $_POST['order_id'];
        $order_date = $_POST['order_date'];
        $order_amt = $_POST['order_amt'];
        $order_st = $_POST['order_st'];
        $order_pay_code = isset($_POST['order_pay_code']) ? $_POST['order_pay_code'] : '';
        $order_pay_error = isset($_POST['order_pay_error']) ? $_POST['order_pay_error'] : '';
        $user_id = $_POST['user_id'];
        $fy_ssn = $_POST['fy_ssn'];
        $card_no = $_POST['card_no'];
        $RSA = $_POST['RSA'];

        $fy_date = $order_date;
        $data = $mchnt_cd . '|' . $user_id . '|' . $order_id . '|' . $order_amt . '|' . $fy_date . '|' . $card_no . '|' . $fy_ssn;

        $dataGBK = iconv('UTF-8', 'GBK', $data);

        // 测试用公钥，在正式环境时，更换为正式公钥
        //$rsaKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCn26E6VU4mVfUlsaScZDuPyYTSszoFCS7ctk6K6kO4y6xZrrVSoGhrd6ej1PXa421uqvDEpmrrnZBaJO0y7S/6niWNzwZQ5ajWo929ZH0HrqsD4DENUEyBTj8U9etnxx7J1wZFtPzgHd3FrUSj1RVjpy5QA40ls29KD2DhJU/oFwIDAQAB';
        $rsaKey = $this->_public_RSA;
        $pemKey = chunk_split($rsaKey, 64, "\n");
        $pem = "-----BEGIN PUBLIC KEY-----\n" . $pemKey . "-----END PUBLIC KEY-----\n";
        $pubKey = openssl_pkey_get_public($pem);

        $ret = openssl_verify($dataGBK, base64_decode($RSA), $pubKey, OPENSSL_ALGO_MD5);

        // 记录一个回调日志
        $fp = fopen(APP_ROOT_PATH . 'system/payment/log/fuyouquai.log', 'a');
        fwrite($fp, date('Y-m-d H:i:s') . '-' . $data . "\r\n");
        fwrite($fp, $ret . "\r\n");
        fwrite($fp, json_encode($_POST) . "\r\n");
        fclose($fp);

        if (!$ret || $order_pay_code != "0000") {
        	echo "RespCode=9999|JumpURL=".SITE_DOMAIN.url("index","payment#pay",array("id"=>$order_id)); 
        } else {
			require_once APP_ROOT_PATH."system/libs/cart.php";
			$rs = payment_paid($payment_notice['id'],$fy_ssn);	
			
			$is_paid = intval($GLOBALS['db']->getOne("select is_paid from ".DB_PREFIX."payment_notice where id = '".intval($payment_notice['id'])."'"));
			if ($is_paid == 1){
				echo "RespCode=0000|JumpURL=".SITE_DOMAIN.url("index","payment#incharge_done",array("id"=>$payment_notice['id'])); //支付成功
			}else{
				echo "RespCode=9999|JumpURL=".SITE_DOMAIN.url("index","payment#pay",array("id"=>$payment_notice['id'])); 
			}									
        }
    }
    
     public function notify($request) {
		$return_res = array(
            'info' => '',
            'status' => false,
        );
		
        // 获得返回的数据
        $mchnt_cd = $_POST['mchnt_cd'];
        $order_id = $_POST['order_id'];
        $order_date = $_POST['order_date'];
        $order_amt = $_POST['order_amt'];
        $order_st = $_POST['order_st'];
        $order_pay_code = isset($_POST['order_pay_code']) ? $_POST['order_pay_code'] : '';
        $order_pay_error = isset($_POST['order_pay_error']) ? $_POST['order_pay_error'] : '';
        $user_id = $_POST['user_id'];
        $fy_ssn = $_POST['fy_ssn'];
        $card_no = $_POST['card_no'];
        $RSA = $_POST['RSA'];

        $fy_date = $order_date;
        $data = $mchnt_cd . '|' . $user_id . '|' . $order_id . '|' . $order_amt . '|' . $fy_date . '|' . $card_no . '|' . $fy_ssn;

        $dataGBK = iconv('UTF-8', 'GBK', $data);

        // 测试用公钥，在正式环境时，更换为正式公钥
        //$rsaKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCn26E6VU4mVfUlsaScZDuPyYTSszoFCS7ctk6K6kO4y6xZrrVSoGhrd6ej1PXa421uqvDEpmrrnZBaJO0y7S/6niWNzwZQ5ajWo929ZH0HrqsD4DENUEyBTj8U9etnxx7J1wZFtPzgHd3FrUSj1RVjpy5QA40ls29KD2DhJU/oFwIDAQAB';
        $rsaKey = $this->_public_RSA;
        $pemKey = chunk_split($rsaKey, 64, "\n");
        $pem = "-----BEGIN PUBLIC KEY-----\n" . $pemKey . "-----END PUBLIC KEY-----\n";
        $pubKey = openssl_pkey_get_public($pem);

        $ret = openssl_verify($dataGBK, base64_decode($RSA), $pubKey, OPENSSL_ALGO_MD5);

        /*比对连接加密字符串*/
        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where notice_sn = '".$order_id."'");
        //dump($payment_notice);die;

        if (!$ret || trim($order_pay_code) != "0000") {
        	showErr($GLOBALS['payment_lang']["VALID_ERROR"]);
        } else {
			$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$payment_notice['order_id']);
			require_once APP_ROOT_PATH."system/libs/cart.php";
			$rs = payment_paid($payment_notice['id'],$fy_ssn);						
			if($rs)
			{
                //如是快捷把bank_id 设置为卡号
                $GLOBALS['db']->query("update ".DB_PREFIX."payment_notice set bank_id = '".$card_no."' where id = ".$payment_notice['id']);

				$rs = order_paid($payment_notice['order_id']);				
				if($rs)
				{
					//开始更新相应的outer_notice_sn					
					//$GLOBALS['db']->query("update ".DB_PREFIX."payment_notice set outer_notice_sn = '".$gopayOutOrderId."' where id = ".$payment_notice['id']);
					if($order_info['type']==0)
						app_redirect(url("index","payment#done",array("id"=>$payment_notice['order_id']))); //支付成功
					else
						app_redirect(url("index","payment#incharge_done",array("id"=>$payment_notice['order_id']))); //支付成功
				}
				else 
				{
					if($order_info['pay_status'] == 2)
					{				
						if($order_info['type']==0)
							app_redirect(url("index","payment#done",array("id"=>$payment_notice['order_id']))); //支付成功
						else
							app_redirect(url("index","payment#incharge_done",array("id"=>$payment_notice['order_id']))); //支付成功
					}
					else
						app_redirect(url("index","payment#pay",array("id"=>$payment_notice['id'])));
				}
			}
			else
			{
				app_redirect(url("index","payment#pay",array("id"=>$payment_notice['id'])));
			}
        }
    }

    public function get_display_code() {
        $payment_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment where class_name='Fuyouquai'");
		if($payment_item)
		{
			$payment_cfg = unserialize($payment_item['config']);

	        $html = "<style type='text/css'>.fuyou_types{float:left; display:block; background:url(".SITE_DOMAIN.APP_ROOT."/system/payment/Fuyouquai/banklist_hnapay.jpg); font-size:0px; width:150px; height:10px; text-align:left; padding:15px 0px;}";
	        $html .=".gfb_type_0{background-position:15px -908px; }"; //中国建设银行
	        $html .=".gfb_type_CCB{background-position:15px -72px; }"; //中国建设银行
	        $html .=".gfb_type_CMB{background-position:15px -196px; }"; //招商银行
	        $html .=".gfb_type_ICBC{background-position:15px 3px; }"; //中国工商银行
	        $html .=".gfb_type_BOC{background-position:15px -113px; }"; //中国银行
	        $html .=".gfb_type_ABC{background-position:15px -34px; }"; //中国农业银行
	        $html .=".gfb_type_BOCOM{background-position:15px -155px; }"; //交通银行
	        $html .=".gfb_type_CMBC{background-position:15px -230px; }"; //中国民生银行
	        $html .=".gfb_type_HXBC{background-position:15px -358px; }"; //华夏银行
	        $html .=".gfb_type_CIB{background-position:15px -270px; }"; //兴业银行
	        $html .=".gfb_type_SPDB{background-position:15px -312px; }"; //上海浦东发展银行
	        $html .=".gfb_type_GDB{background-position:15px -475px; }"; //广东发展银行
	        $html .=".gfb_type_CITIC{background-position:15px -396px; }"; //中信银行
	        $html .=".gfb_type_CEB{background-position:15px -435px; }"; //光大银行
	        $html .=".gfb_type_PSBC{background-position:15px -513px; }"; //中国邮政储蓄银行
	        $html .=".gfb_type_SDB{background-position:15px -558px; }"; //深圳发展银行
	        $html .=".gfb_type_BOBJ{background-position:15px -697px; }"; //北京银行
			$html .=".gfb_type_PAB{background-position:15px -827px; }"; //平安银行
			$html .=".gfb_type_BOS{background-position:15px -789px; }"; //上海银行
			$html .=".gfb_type_NBCB{background-position:15px -649px; }"; //宁波银行
			$html .=".gfb_type_NJCB{background-position:15px -743px; }"; //南京银行
			$html .=".gfb_type_TCCB{background-position:15px -869px; }"; //天津银行
	        $html .="</style>";
	        $html .="<script type='text/javascript'>function set_bank(bank_id)";
			$html .="{";
			$html .="$(\"input[name='bank_id']\").val(bank_id);";
			$html .="}</script>";
			$html.= "<h3 class='clearfix tl'><b>富友支付</b></h3><div class='blank1'></div><hr />";
	       foreach ($payment_cfg['fuyou_gateway'] AS $key=>$val)
	        {
	            $html  .= "<label class='fuyou_types gfb_type_".$key." ui-radiobox' rel='common_payment'><input type='radio' name='payment' value='".$payment_item['id']."' rel='".$key."' onclick='set_bank(\"".$key."\")' /></label>";
	        }
	        $html .= "<input type='hidden' name='bank_id' /><div class='blank'></div>";
			return $html;
		}
		else{
			return '';
		}
    }
    /**
     * 字符转义
     * @return string
     */
    function fStripslashes($string)
    {
            if(is_array($string))
            {
                    foreach($string as $key => $val)
                    {
                            unset($string[$key]);
                            $string[stripslashes($key)] = fStripslashes($val);
                    }
            }
            else
            {
                    $string = stripslashes($string);
            }

            return $string;
    }

}

?>
